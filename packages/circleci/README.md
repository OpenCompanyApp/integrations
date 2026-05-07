# Integration: CircleCI

> CircleCI integration for OpenCompany agents - manage pipelines, workflows, jobs, projects, contexts, schedules, webhooks, and insights.

## Configuration

Provide `access_token`. Optional `url` defaults to `https://circleci.com/api`.

CircleCI API v2 uses the `Circle-Token` header with a personal API token.

## Coverage

This package exposes 68 tools across CircleCI API v2:

- Pipelines: list, trigger, continue, inspect config, values, project pipelines, and workflow lists.
- Workflows and jobs: get, list jobs, approve, cancel, rerun, cancel jobs, artifacts, and test metadata.
- Projects: project lookup, deletion, checkout keys, environment variables, and project settings.
- Contexts: create, list, get, delete, environment variables, and restrictions.
- Schedules and webhooks: create, list, get, update, and delete.
- Insights: project summaries, branches, flaky tests, workflow metrics, job metrics, and job timeseries.
- Raw `api_get`, `api_post`, `api_patch`, `api_put`, and `api_delete` tools for less common CircleCI endpoints.

## Notes

CircleCI slugs such as `gh/org/repo` are passed as one `project_slug` value. The integration preserves slash-separated slug segments when building API paths.

## License

MIT - see [LICENSE](LICENSE)
