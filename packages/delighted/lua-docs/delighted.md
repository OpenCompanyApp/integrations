# Delighted

Use the `delighted` namespace to manage Delighted CX survey workflows: sending surveys, reading responses, retrieving metrics, managing people, unsubscribes, bounces, and Autopilot memberships.

Authentication uses Basic auth with the private Delighted API key as the username and an empty password. Agents should not pass the API key manually.

## Common workflows

- Use `delighted_send_person` with `email` to create/update a person and schedule a survey.
- Use `delighted_list_survey_responses` with pagination and date filters to export feedback.
- Use `delighted_get_metrics` for NPS and response breakdowns.
- Use `delighted_create_survey_response` when a score/comment was collected outside Delighted.
- Use `delighted_delete_pending_survey_request` before rescheduling or cancelling a queued survey request.
- Use `delighted_unsubscribe_person`, `delighted_list_unsubscribes`, and `delighted_list_bounces` to keep contact eligibility clean.
- Use the email and SMS Autopilot membership tools to add, list, or remove people from recurring surveys.

## Examples

```lua
delighted_send_person({
  email = "customer@example.test",
  payload = {
    name = "Example Customer",
    properties = {
      plan = "pro"
    }
  }
})
```

```lua
delighted_list_survey_responses({
  payload = {
    since = 1777833600,
    per_page = 100
  }
})
```

```lua
delighted_delete_person({
  person_identifier = "email:customer@example.test"
})
```

The raw `delighted_api_get`, `delighted_api_post`, and `delighted_api_delete` tools only accept relative paths such as `/v1/metrics.json`; full URLs are rejected.
