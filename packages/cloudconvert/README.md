# Integration: CloudConvert

> CloudConvert integration for OpenCompany agents - manage jobs, tasks, operations, webhooks, signed URLs, and file conversions.

## Configuration

Provide `api_key`. Optional `url` and `sync_url` settings default to:

- `https://api.cloudconvert.com/v2`
- `https://sync.api.cloudconvert.com/v2`

## Coverage

This package exposes 23 tools across the CloudConvert v2 API:

- Jobs: create, sync create, get, wait, list, and delete.
- Tasks: generic operation creation, get, wait, list, cancel, retry, and delete.
- Operations: discover formats, engines, versions, and task options.
- Webhooks: create, list, delete, and verify webhook signatures.
- Raw `api_get`, `api_post`, `api_put`, and `api_delete` tools for less common CloudConvert endpoints.
- Signed URL generation for on-demand conversion links.

## Notes

CloudConvert task operations are created by submitting named task definitions inside a job payload. Use `list_operations` to discover operation-specific parameters, then pass those task definitions to `create_job` or `create_job_sync`.

## License

MIT - see [LICENSE](LICENSE)
