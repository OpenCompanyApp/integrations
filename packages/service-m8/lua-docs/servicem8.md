# ServiceM8 Integration

## Tools

### servicem8_list_jobs
List jobs from ServiceM8.
- **Parameters:** `status` (string, optional), `limit` (integer, optional), `offset` (integer, optional)
- **Returns:** Array of job objects with UUID, status, client, dates, and description.

### servicem8_get_job
Get a specific job by UUID.
- **Parameters:** `uuid` (string, required)
- **Returns:** Full job details.

### servicem8_list_clients
List clients from ServiceM8.
- **Parameters:** `limit` (integer, optional), `offset` (integer, optional)
- **Returns:** Array of client objects.

### servicem8_get_client
Get a specific client by UUID.
- **Parameters:** `uuid` (string, required)
- **Returns:** Full client details.

### servicem8_create_job
Create a new job in ServiceM8.
- **Parameters:** `client_id` (string, required), `template_id` (string, optional), `description` (string, optional)
- **Returns:** The created job object.

### servicem8_list_activities
List activity records from ServiceM8.
- **Parameters:** `job_uuid` (string, optional), `limit` (integer, optional), `offset` (integer, optional)
- **Returns:** Array of activity objects.

### servicem8_get_current_user
Get the currently authenticated ServiceM8 user.
- **Parameters:** (none)
- **Returns:** User profile object.
