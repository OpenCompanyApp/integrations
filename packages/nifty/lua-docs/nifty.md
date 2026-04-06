# Nifty Integration

## Tools

### nifty_list_projects
List all projects in Nifty.
- **Parameters:** `limit` (integer, optional), `offset` (integer, optional)

### nifty_get_project
Get details of a specific project.
- **Parameters:** `project_id` (string, required)

### nifty_list_tasks
List tasks with optional filters.
- **Parameters:** `project_id` (string, optional), `status` (string, optional), `assignee_id` (string, optional), `milestone_id` (string, optional), `task_list_id` (string, optional), `limit` (integer, optional), `offset` (integer, optional)

### nifty_get_task
Get details of a specific task.
- **Parameters:** `task_id` (string, required)

### nifty_create_task
Create a new task in a project.
- **Parameters:** `title` (string, required), `project_id` (string, required), `description` (string, optional), `task_list_id` (string, optional), `assignee_id` (string, optional), `due_date` (string, optional), `priority` (string, optional), `labels` (array, optional)

### nifty_get_current_user
Get the authenticated user profile.
- **Parameters:** none
