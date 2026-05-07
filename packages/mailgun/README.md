# Integration: Mailgun

> Mailgun integration for OpenCompany agents - manage email sending, domains, events, stats, suppressions, routes, webhooks, mailing lists, templates, and IPs.

## Configuration

Provide `api_key` and a default sending `domain`. Mailgun authenticates with HTTP Basic Auth using username `api` and the API key as the password.

## Coverage

This package exposes 72 focused tools across Mailgun API v3 and v4:

- Sending, MIME sending, events, stats, tags, domains, domain IPs, account IPs, and IP pools.
- Bounces, complaints, unsubscribes, and allowlists.
- Routes and domain webhooks.
- Mailing lists and members, including bulk member import.
- Stored templates and template versions.
- Raw `api_get`, `api_post`, `api_put`, and `api_delete` tools for less common Mailgun endpoints.

## License

MIT - see [LICENSE](LICENSE)
