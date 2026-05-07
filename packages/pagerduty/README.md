# PagerDuty Integration

Generated from PagerDuty's official REST OpenAPI schema.

Source: `https://raw.githubusercontent.com/PagerDuty/api-schema/main/reference/REST/openapiv3.json`

This package exposes the REST API surface for incident response automation: incidents, alerts, services, escalation policies, schedules, users, teams, automation actions, analytics, status pages, maintenance windows, priorities, tags, webhooks, and related account resources.

The integration uses PagerDuty REST API tokens with `Authorization: Bearer` and the PagerDuty v2 media type in the `Accept` header. Events API and SCIM endpoints are separate PagerDuty API families and are not included in this REST package.