# Asana — Ruby API Supplement

Namespace: `app.integrations.asana`

Asana uses a personal access token or OAuth access token as a bearer token. The API returns a top-level `data` key and may include pagination metadata such as `next_page`; this integration preserves that shape.

## Tasks

Create a task:

```ruby
task = app.integrations.asana.create_task(name: "Draft launch plan", notes: "Collect open work && owners.", projects: ["1200000000000001"], assignee: "me", due_on: "2026-05-20")
```
List tasks with cursor pagination:

```ruby
page = app.integrations.asana.list_tasks(project: "1200000000000001", limit: 50)
page.data.each do |task|
  puts((task.gid).to_s + " " + (task.name).to_s)
end
if page.next_page
  next_page = app.integrations.asana.list_tasks(project: "1200000000000001", offset: page.next_page.offset)
end
```
Update or delete a task:

```ruby
app.integrations.asana.update_task(id: "1200000000000002", completed: true)
app.integrations.asana.delete_task(id: "1200000000000002")
```
## Comments And Subtasks

```ruby
app.integrations.asana.add_comment(task_id: "1200000000000002", text: "This is ready for review.")
comments = app.integrations.asana.list_comments(task_id: "1200000000000002", limit: 20)
subtask = app.integrations.asana.create_subtask(parent_id: "1200000000000002", name: "Check screenshots", assignee: "me")
```
## Projects, Sections, Teams, Users, And Tags

```ruby
workspaces = app.integrations.asana.list_workspaces()
projects = app.integrations.asana.list_projects(workspace: workspaces.data[0].gid, archived: false)
sections = app.integrations.asana.list_sections(project_id: projects.data[0].gid)
teams = app.integrations.asana.list_teams(workspace_id: workspaces.data[0].gid)
users = app.integrations.asana.list_users(workspace: workspaces.data[0].gid, limit: 50)
tags = app.integrations.asana.list_tags(workspace: workspaces.data[0].gid)
```
## Output Notes

Write tools return Asana's response object, usually `{ data = {...} }`. List tools return `{ data = {...}, next_page = {...} }` when another page exists. Use `offset = result.next_page.offset` to fetch the next page.

## Multi-Account Usage

```ruby
app.integrations.asana.create_task()
app.integrations.asana.default.create_task()
app.integrations.asana.operations.create_task()
```