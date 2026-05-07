# Integration: MailerSend

MailerSend integration for Laravel agents. It uses the MailerSend API V1 to send transactional email and manage messages, templates, domains, recipients, suppressions, analytics, webhooks, inbound routes, and SMTP users.

Official API reference: https://developers.mailersend.com/api/v1/

## Credentials

- `api_token`: MailerSend API token.

## Tool Surface

The package exposes 47 tools across:

- Single and bulk email sending.
- Messages, templates, domains, DNS records, and domain verification.
- Activity and analytics.
- Recipients and suppression lists.
- Webhooks and inbound email routes.
- SMTP users.

Tool arguments use snake_case and are passed to MailerSend's REST API with native response shapes.
