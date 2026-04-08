# Constant Contact Integration

Email marketing integration for [OpenCompany](https://github.com/OpenCompanyApp). Manage contacts, campaigns, and lists via the Constant Contact v3 API.

## Tools

| Tool | Type | Description |
|------|------|-------------|
| `constantcontact_list_contacts` | read | List contacts with pagination and status filtering |
| `constantcontact_get_contact` | read | Get detailed info for a single contact |
| `constantcontact_create_contact` | write | Create a new contact with email, name, and list assignments |
| `constantcontact_list_campaigns` | read | List email campaigns |
| `constantcontact_list_lists` | read | List all contact lists |
| `constantcontact_get_current_user` | read | Get authenticated user's account info |

## Setup

1. Create a Constant Contact developer account at [developer.constantcontact.com](https://developer.constantcontact.com/)
2. Register an application to obtain OAuth2 credentials
3. Generate an access token (via authorization code or client credentials flow)
4. Configure the integration in OpenCompany with your access token

## Configuration

| Field | Type | Required | Default |
|-------|------|----------|---------|
| `access_token` | secret | yes | — |
| `url` | url | no | `https://api.cc.email/v3` |

## API Reference

See the [Constant Contact v3 API documentation](https://developer.constantcontact.com/api_reference/api-reference.html) for full endpoint details.

## License

MIT
