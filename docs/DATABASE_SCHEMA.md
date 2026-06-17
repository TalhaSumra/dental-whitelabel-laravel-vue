# Database Schema

## clients
Dental clinics and sales leads.

Important fields: `clinic_name`, `city`, `province`, `website_url`, `services`, `status`.

## users
Agency users, delivery team users, and client users.

Important fields: `role`, `client_id`, `is_active`.

## agency_settings
White-label branding shown in client-facing pages and reports.

## service_packages
Reusable offers: Website + SEO Launch, Local Dental SEO, GBP Management, Google Ads.

## projects
Client work containers. Each project has a client price and a white-label cost so margin is visible internally.

## tasks
Internal/client-visible task tracking. Delivery team tasks should remain `internal` unless the agency approves visibility.

## deliverables
Files, reports, URLs, designs, pages, SEO documents. Client visibility is explicitly controlled.

## monthly_reports
Client-facing SEO/progress reports. Drafts remain internal until published.

## audit_leads
Public website form submissions.

## onboarding_forms
Questionnaire answers for clinic onboarding.
