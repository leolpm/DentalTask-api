# DentalTask AI – Contexto do Projeto

Você é um agente de código trabalhando no projeto **DentalTask AI**.

## Objetivo do sistema

DentalTask AI é um SaaS multi-tenant para clínicas odontológicas.  
Principais objetivos:

- Cadastro e gestão de **tenants** (clínicas / consultórios).
- Gestão de **pacientes**, **profissionais** e seus relacionamentos.
- Fluxo de **atendimento humanizado**:
  - lembretes de consultas, medicação e retornos;
  - integração com WhatsApp / e-mail para comunicação;
  - anotações clínicas e histórico do paciente (incluindo interações com IA).
- Integrações futuras com sistemas odontológicos externos (ex.: Dental Office).

O foco é: experiência moderna, segura e fácil de usar para dentistas e pacientes.

## Stack técnica

- **Backend:** Laravel 12 (PHP 8.4)
- **Frontend:** Inertia.js + Vue 3 (composition API)
- **UI/tema:** Template Phoenix (Bootstrap) adaptado
- **Autenticação:** Laravel Breeze/Inertia, login padrão + login social (Google)
- **Banco:** MySQL
- Multi-tenant por `tenant_id` em tabelas centrais (Users, Patients, etc.).

## Padrões importantes

- Usar **Form Requests** para validação.
- Usar **Policies** para autorização por tenant e por usuário.
- Rotas web protegidas por `auth` e `verified` onde fizer sentido.
- Páginas Inertia organizadas em:
  - `resources/js/Layouts/AppLayout.vue`
  - `resources/js/Pages/Auth/*`
  - `resources/js/Pages/Patients/*`
  - etc.

## Estilo das telas

- Base visual inspirada no Phoenix:
  - uso de classes Bootstrap (containers, rows, cards, tables).
  - layout principal com sidebar + topbar em `AppLayout.vue`.
- Componentes Vue devem:
  - ser reativos com composition API;
  - separar lógica (script) e template de forma limpa;
  - evitar duplicação de código (criar componentes reutilizáveis quando necessário).

## Funcionalidades já planejadas

1. **Módulo de Pacientes**
   - CRUD completo de pacientes.
   - Filtros por nome, e-mail, telefone.
   - Paginação, ordenação simples.
   - Tela de listagem + tela de criação/edição.

2. **Notas / Anotações do Paciente**
   - Notas textuais ligadas a um paciente.
   - Classificações/tag para facilitar filtros (ex.: “medicação”, “cirurgia”, “perfil familiar”).
   - Espaço para sugestões geradas por IA.

3. **Fluxo de verificação de e-mail e cadastro completo**
   - Usuário novo precisa:
     - confirmar e-mail;
     - completar cadastro do tenant (dados da clínica).
   - Middlewares devem redirecionar:
     - se e-mail não confirmado → tela de reenviar confirmação;
     - se tenant incompleto → tela de completar cadastro.

## Como quero que você trabalhe

- Sempre analisar o código existente antes de sugerir novas estruturas.
- Quando eu pedir uma funcionalidade:
  1. Descrever quais arquivos pretende criar/alterar.
  2. Sugerir o código completo desses arquivos.
  3. Explicar brevemente o fluxo (rotas → controller → requests → Vue).

- Para testes:
  - Priorizar criação de **Feature tests** em Laravel.
  - Sempre que possível, propor testes que cubram os casos principais.

Quando eu pedir tarefas, assuma este contexto como padrão.
