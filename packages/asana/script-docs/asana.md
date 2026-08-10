# Asana — JavaScript API Supplement

Namespace: `app.integrations.asana`

Asana uses a personal access token or OAuth access token as a bearer token. The API returns a top-level `data` key and may include pagination metadata such as `next_page`; this integration preserves that shape.

## Tasks

Create a task:

```js
var task = app.integrations.asana.create_task({
  name: "Draft launch plan",
  notes: "Collect open work && owners.",
  projects: [ "1200000000000001" ],
  assignee: "me",
  due_on: "2026-05-20",
})
```
List tasks with cursor pagination:

```js
var page = app.integrations.asana.list_tasks({
  project: "1200000000000001",
  limit: 50,
})

for (const task of (page.data)) {
  console.log(task.gid + " " + task.name)
}

if (page.next_page) {
  var next_page = app.integrations.asana.list_tasks({
    project: "1200000000000001",
    offset: page.next_page.offset,
  })
}
```
Update or delete a task:

```js
app.integrations.asana.update_task({
  id: "1200000000000002",
  completed: true,
})

app.integrations.asana.delete_task({
  id: "1200000000000002",
})
```
## Comments And Subtasks

```js
app.integrations.asana.add_comment({
  task_id: "1200000000000002",
  text: "This is ready for review.",
})

var comments = app.integrations.asana.list_comments({
  task_id: "1200000000000002",
  limit: 20,
})

var subtask = app.integrations.asana.create_subtask({
  parent_id: "1200000000000002",
  name: "Check screenshots",
  assignee: "me",
})
```
## Projects, Sections, Teams, Users, And Tags

```js
var workspaces = app.integrations.asana.list_workspaces({})
var projects = app.integrations.asana.list_projects({
  workspace: workspaces.data[0].gid,
  archived: false,
})

var sections = app.integrations.asana.list_sections({
  project_id: projects.data[0].gid,
})

var teams = app.integrations.asana.list_teams({
  workspace_id: workspaces.data[0].gid,
})

var users = app.integrations.asana.list_users({
  workspace: workspaces.data[0].gid,
  limit: 50,
})

var tags = app.integrations.asana.list_tags({
  workspace: workspaces.data[0].gid,
})
```
## Output Notes

Write tools return Asana's response object, usually `{ data = {...} }`. List tools return `{ data = {...}, next_page = {...} }` when another page exists. Use `offset = result.next_page.offset` to fetch the next page.

## Multi-Account Usage

```js
app.integrations.asana.create_task({ /* parameters */ })
app.integrations.asana.default.create_task({ /* parameters */ })
app.integrations.asana.operations.create_task({ /* parameters */ })
```