<?php

namespace Tests\Feature;

use App\Models\Report;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReportAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_report_form_is_public(): void
    {
        $this->get(route('lapor.create'))
            ->assertOk()
            ->assertSee('Form Pelaporan Banjir');
    }

    public function test_guest_is_redirected_from_report_list_to_login(): void
    {
        $this->get(route('laporan.index'))
            ->assertRedirect(route('login'));
    }

    public function test_guest_cannot_see_officer_profile(): void
    {
        $this->get(route('petugas.profile'))
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_officer_can_open_report_management(): void
    {
        $officer = User::factory()->create();

        $this->actingAs($officer)
            ->get(route('laporan.index'))
            ->assertOk()
            ->assertSee('Daftar Laporan Banjir');
    }

    public function test_guest_can_submit_a_report(): void
    {
        $this->post(route('lapor.store'), [
            'name' => 'Warga Bandung',
            'phone' => '081234567890',
            'address' => 'Kecamatan Baleendah',
            'description' => 'Air mulai menggenangi jalan utama.',
        ])
            ->assertRedirect(route('lapor.create'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('reports', [
            'name' => 'Warga Bandung',
            'status' => 'Menunggu Verifikasi',
        ]);
    }

    public function test_admin_can_update_report_status(): void
    {
        $admin = User::factory()->create();
        $report = Report::create([
            'name' => 'Warga Bandung',
            'phone' => '081234567890',
            'address' => 'Baleendah',
            'description' => 'Genangan menghambat jalan.',
        ]);

        $this->actingAs($admin)
            ->patch(route('laporan.status', $report), ['status' => 'Sedang Diproses'])
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertDatabaseHas('reports', [
            'id' => $report->id,
            'status' => 'Sedang Diproses',
        ]);
    }

    public function test_guest_cannot_update_report_status(): void
    {
        $report = Report::create([
            'name' => 'Warga Bandung',
            'phone' => '081234567890',
            'address' => 'Baleendah',
            'description' => 'Genangan menghambat jalan.',
        ]);

        $this->patch(route('laporan.status', $report), ['status' => 'Selesai'])
            ->assertRedirect(route('login'));

        $this->assertDatabaseHas('reports', [
            'id' => $report->id,
            'status' => 'Menunggu Verifikasi',
        ]);
    }
}
