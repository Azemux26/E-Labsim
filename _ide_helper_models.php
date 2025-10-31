<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property int $schedule_id
 * @property string $message
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\LabSchedule $labschedule
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabNotification gagal()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabNotification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabNotification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabNotification query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabNotification terkirim()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabNotification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabNotification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabNotification whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabNotification whereScheduleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabNotification whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabNotification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabNotification whereUserId($value)
 */
	class LabNotification extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $lab_simulator_id
 * @property int|null $kalab_id
 * @property int|null $pengajar_id
 * @property \Illuminate\Support\Carbon $tanggal
 * @property string $jam_mulai
 * @property string $jam_selesai
 * @property string $jenis_kegiatan
 * @property string $detail_materi
 * @property int $jumlah_peserta
 * @property string $status_verifikasi
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $createdBy
 * @property-read mixed $rentang_waktu
 * @property-read \App\Models\User|null $kalab
 * @property-read \App\Models\LabSimulator $labSimulator
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LabNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\User|null $pengajar
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabSchedule belumDisetujui()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabSchedule disetujui()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabSchedule filterByTahun($tahun)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabSchedule forUser($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabSchedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabSchedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabSchedule query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabSchedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabSchedule whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabSchedule whereDetailMateri($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabSchedule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabSchedule whereJamMulai($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabSchedule whereJamSelesai($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabSchedule whereJenisKegiatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabSchedule whereJumlahPeserta($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabSchedule whereKalabId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabSchedule whereLabSimulatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabSchedule wherePengajarId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabSchedule whereStatusVerifikasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabSchedule whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabSchedule whereUpdatedAt($value)
 */
	class LabSchedule extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LabSchedule> $labschedules
 * @property-read int|null $labschedules_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabSimulator lab()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabSimulator newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabSimulator newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabSimulator query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabSimulator simulator()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabSimulator whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabSimulator whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabSimulator whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabSimulator whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabSimulator whereUpdatedAt($value)
 */
	class LabSimulator extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $display_name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereUpdatedAt($value)
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int|null $role_id
 * @property string $name
 * @property string $password
 * @property string|null $no_whatsapp
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property \Illuminate\Support\Carbon|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LabNotification> $labnotifications
 * @property-read int|null $labnotifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LabSchedule> $labschedulesAsKalab
 * @property-read int|null $labschedules_as_kalab_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LabSchedule> $labschedulesAsPengajar
 * @property-read int|null $labschedules_as_pengajar_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LabSchedule> $labschedulesCreated
 * @property-read int|null $labschedules_created_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Role|null $role
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User admin()
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User kalab()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User pengajar()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereNoWhatsapp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTwoFactorConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

