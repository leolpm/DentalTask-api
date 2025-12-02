<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
use App\Models\Dentist;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\MessagingChannel;
use App\Models\AiAgent;
use App\Models\PatientNote;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1) Tenant (clínica)
        $tenant = Tenant::create([
            'name'            => 'Consultório de Saúde Bucal',
            'document'        => '00.000.000/0001-00',
            'subdomain'       => 'consultorio-saude-bucal',
            'whatsapp_number' => '+55 21 99999-9999',
            'status'          => 'active',
        ]);

        // 2) Usuário dono (owner) e super admin
        $ownerUser = User::create([
            'tenant_id'      => $tenant->id,
            'name'           => 'Leonardo (Owner)',
            'email'          => 'owner@example.com',
            'password'       => Hash::make('senha123'), // senha pra login
            'phone'          => '+55 21 98888-8888',
            'is_super_admin' => true,
            'role'           => 'owner',
        ]);

        // 3) Dentista vinculado a esse usuário
        $dentist = Dentist::create([
            'tenant_id'   => $tenant->id,
            'user_id'     => $ownerUser->id,
            'name'        => 'Dr. Leonardo',
            'cro_number'  => 'CRO-RJ 12345',
            'specialty'   => 'Implantodontia',
            'phone'       => '+55 21 98888-8888',
            'email'       => 'dr.leonardo@example.com',
        ]);

        // 4) Paciente de exemplo
        $patient = Patient::create([
            'tenant_id'       => $tenant->id,
            'name'            => 'João da Silva',
            'document'        => '111.222.333-44',
            'birth_date'      => '1990-05-10',
            'gender'          => 'M',
            'phone'           => '+55 21 97777-7777',
            'whatsapp_number' => '+55 21 97777-7777',
            'email'           => 'joao.silva@example.com',
            'main_concern'    => 'medo',
            'notes'           => 'Paciente ansioso, com medo de agulha.',
        ]);

        // 5) Uma consulta agendada
        $appointment = Appointment::create([
            'tenant_id'            => $tenant->id,
            'patient_id'           => $patient->id,
            'dentist_id'           => $dentist->id,
            'treatment_plan_item_id' => null,
            'start_at'             => Carbon::now()->addDays(1)->setTime(14, 0),
            'end_at'               => Carbon::now()->addDays(1)->setTime(14, 30),
            'status'               => 'scheduled',
            'source'               => 'whatsapp',
            'notes'                => 'Primeira avaliação de implante.',
        ]);

        // 6) Canal de mensagem (WhatsApp)
        $channel = MessagingChannel::create([
            'tenant_id'    => $tenant->id,
            'provider'     => 'whatsapp',
            'name'         => 'WhatsApp Principal',
            'phone_number' => '+55 21 99999-9999',
            'config'       => [
                'webhook_url' => 'https://example.com/webhook/whatsapp',
                'token'       => 'SEU_TOKEN_DE_EXEMPLO',
            ],
            'is_active'    => true,
        ]);

        // 7) Agentes de IA: Secretária e Assistente Clínico
        $secretaria = AiAgent::create([
            'tenant_id'     => $tenant->id,
            'name'          => 'Secretária Virtual',
            'type'          => 'secretary',
            'system_prompt' => 'Você é uma secretária simpática, focada em pacientes, que responde dúvidas simples, agenda consultas e reforça tratamentos, sempre de forma acolhedora.',
            'config'        => [
                'model'       => 'gpt-4.1-mini',
                'temperature' => 0.7,
            ],
            'is_active'     => true,
        ]);

        $assistenteClinico = AiAgent::create([
            'tenant_id'     => $tenant->id,
            'name'          => 'Assistente Clínico',
            'type'          => 'clinical_assistant',
            'system_prompt' => 'Você é um assistente clínico técnico e objetivo, focado em coletar dados estruturados dos dentistas e organizar protocolos.',
            'config'        => [
                'model'       => 'gpt-4.1-mini',
                'temperature' => 0.2,
            ],
            'is_active'     => true,
        ]);

        // 8) Uma anotação de paciente (misturando perfil + comportamento)
        PatientNote::create([
            'tenant_id'          => $tenant->id,
            'patient_id'         => $patient->id,
            'dentist_id'         => $dentist->id,
            'created_by_user_id' => $ownerUser->id,
            'ai_agent_id'        => null,
            'message_id'         => null,
            'appointment_id'     => $appointment->id,
            'category'           => 'behavior',
            'title'              => 'Perfil ansioso e esquece medicação',
            'content'            => 'Paciente relata medo de dentista e já comentou que costuma esquecer remédios à noite. Ideal reforçar lembretes de medicação e explicar tudo com calma.',
            'tags'               => ['medroso', 'esquece_medicação'],
            'metadata'           => [
                'medication_reminder_opt_in' => true,
            ],
            'is_pinned'          => true,
            'visible_to_patient' => false,
        ]);
    }
}
