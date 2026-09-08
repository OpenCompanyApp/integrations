# HTTP client for the Bitbucket REST API (v2) — Ruby API Reference

## bitbucket_create_branch

Create a new branch in a Bitbucket repository. Requires a branch name and the target commit hash..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace` | string | yes | The workspace slug or UUID. |
| `repo_slug` | string | yes | The repository slug. |
| `name` | string | yes | The name for the new branch. |
| `target_hash` | string | yes | The commit hash to branch from. |

### Example

```ruby
result = app.integrations.bitbucket.create_branch(workspace: "", repo_slug: "", name: "")
```
## bitbucket_create_issue

Create a new issue in a Bitbucket repository. Requires a title; optionally set content, kind, priority, and assignee..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace` | string | yes | The workspace slug or UUID. |
| `repo_slug` | string | yes | The repository slug. |
| `title` | string | yes | The title of the issue. |
| `content` | string | no | The issue description (Markdown supported). |
| `kind` | string | no | Issue kind: bug, enhancement, proposal, task. Default: bug. |
| `priority` | string | no | Issue priority: trivial, minor, major, critical, blocker. Default: major. |
| `assignee` | string | no | The UUID of the user to assign the issue to. |

### Example

```ruby
result = app.integrations.bitbucket.create_issue(workspace: "", repo_slug: "", title: "")
```
## bitbucket_create_pull_request

Create a new pull request in a Bitbucket repository. Requires a title, source branch, and destination branch..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace` | string | yes | The workspace slug or UUID. |
| `repo_slug` | string | yes | The repository slug. |
| `title` | string | yes | The title of the pull request. |
| `description` | string | no | The pull request description (Markdown supported). |
| `source_branch` | string | yes | The name of the source branch. |
| `destination_branch` | string | no | The name of the destination branch. Default: main. |
| `close_source_branch` | boolean | no | Whether to close the source branch after merge. Default: false. |

### Example

```ruby
result = app.integrations.bitbucket.create_pull_request(workspace: "", repo_slug: "", title: "")
```
## bitbucket_create_repo

Create a new repository in a Bitbucket workspace. Optionally set description, visibility, and language..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace` | string | yes | The workspace slug or UUID. |
| `repo_slug` | string | yes | The slug for the new repository. |
| `description` | string | no | A short description of the repository. |
| `is_private` | boolean | no | Whether the repository should be private. Default: true. |
| `language` | string | no | The main language of the repository (e.g.  |

### Example

```ruby
result = app.integrations.bitbucket.create_repo(workspace: "", repo_slug: "", description: "")
```
## bitbucket_get_file

Get the raw content of a file from a Bitbucket repository at a specific revision..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace` | string | yes | The workspace slug or UUID. |
| `repo_slug` | string | yes | The repository slug. |
| `revision` | string | yes | A commit hash, branch name, or tag. |
| `file_path` | string | yes | The path to the file within the repository. |

### Example

```ruby
result = app.integrations.bitbucket.get_file(workspace: "", repo_slug: "", revision: "")
```
## bitbucket_get_issue

Get details for a specific issue in a Bitbucket repository..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace` | string | yes | The workspace slug or UUID. |
| `repo_slug` | string | yes | The repository slug. |
| `issue_id` | integer | yes | The issue identifier. |

### Example

```ruby
result = app.integrations.bitbucket.get_issue(workspace: "", repo_slug: "", issue_id: 0)
```
## bitbucket_get_pull_request

Get details for a specific pull request in a Bitbucket repository..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace` | string | yes | The workspace slug or UUID. |
| `repo_slug` | string | yes | The repository slug. |
| `pr_id` | integer | yes | The pull request identifier. |

### Example

```ruby
result = app.integrations.bitbucket.get_pull_request(workspace: "", repo_slug: "", pr_id: 0)
```
## bitbucket_get_repo

Get details for a specific Bitbucket repository by workspace and repo slug..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace` | string | yes | The workspace slug or UUID. |
| `repo_slug` | string | yes | The repository slug. |

### Example

```ruby
result = app.integrations.bitbucket.get_repo(workspace: "", repo_slug: "")
```
## bitbucket_list_branches

List branches in a Bitbucket repository. Supports pagination..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace` | string | yes | The workspace slug or UUID. |
| `repo_slug` | string | yes | The repository slug. |
| `pagelen` | integer | no | Number of results per page (1-100). Default: 10. |

### Example

```ruby
result = app.integrations.bitbucket.list_branches(workspace: "", repo_slug: "", pagelen: 0)
```
## bitbucket_list_commits

List commits in a Bitbucket repository. Supports filtering by revision and path..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace` | string | yes | The workspace slug or UUID. |
| `repo_slug` | string | yes | The repository slug. |
| `revision` | string | no | A commit hash, branch name, or tag to list commits for. |
| `path` | string | no | Filter commits to those affecting a specific file path. |
| `pagelen` | integer | no | Number of results per page (1-100). Default: 10. |

### Example

```ruby
result = app.integrations.bitbucket.list_commits(workspace: "", repo_slug: "", revision: "")
```
## bitbucket_list_issues

List issues in a Bitbucket repository. Supports filtering by state, kind, and priority..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace` | string | yes | The workspace slug or UUID. |
| `repo_slug` | string | yes | The repository slug. |
| `state` | string | no | Filter by issue state: new, open, resolved, closed, on hold, wontfix, duplicate, invalid. |
| `kind` | string | no | Filter by kind: bug, enhancement, proposal, task. |
| `priority` | string | no | Filter by priority: trivial, minor, major, critical, blocker. |
| `pagelen` | integer | no | Number of results per page (1-100). Default: 10. |

### Example

```ruby
result = app.integrations.bitbucket.list_issues(workspace: "", repo_slug: "", state: "")
```
## bitbucket_list_pull_requests

List pull requests in a Bitbucket repository. Supports filtering by state and pagination..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace` | string | yes | The workspace slug or UUID. |
| `repo_slug` | string | yes | The repository slug. |
| `state` | string | no | Filter by state: OPEN, MERGED, DECLINED, SUPERSEDED. |
| `pagelen` | integer | no | Number of results per page (1-100). Default: 10. |

### Example

```ruby
result = app.integrations.bitbucket.list_pull_requests(workspace: "", repo_slug: "", state: "")
```
## bitbucket_list_repos

List repositories in a Bitbucket workspace. Supports sorting and pagination..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace` | string | yes | The workspace slug or UUID. |
| `sort` | string | no | Sort field (e.g.  |
| `pagelen` | integer | no | Number of results per page (1-100). Default: 10. |
| `page` | string | no | Page URL or page number for pagination. |

### Example

```ruby
result = app.integrations.bitbucket.list_repos(workspace: "", sort: "", pagelen: 0)
```
## bitbucket_merge_pull_request

Merge a Bitbucket pull request. Optionally provide a merge commit message..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace` | string | yes | The workspace slug or UUID. |
| `repo_slug` | string | yes | The repository slug. |
| `pr_id` | integer | yes | The pull request identifier. |
| `merge_commit_message` | string | no | An optional message for the merge commit. |

### Example

```ruby
result = app.integrations.bitbucket.merge_pull_request(workspace: "", repo_slug: "", pr_id: 0)
```
## bitbucket_update_issue

Update an existing issue in a Bitbucket repository. Can change title, content, state, priority, and assignee..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace` | string | yes | The workspace slug or UUID. |
| `repo_slug` | string | yes | The repository slug. |
| `issue_id` | integer | yes | The issue identifier. |
| `title` | string | no | The new title of the issue. |
| `content` | string | no | The new issue description (Markdown supported). |
| `state` | string | no | New state: new, open, resolved, closed, on hold, wontfix, duplicate, invalid. |
| `priority` | string | no | New priority: trivial, minor, major, critical, blocker. |
| `assignee` | string | no | The UUID of the user to assign the issue to. |

### Example

```ruby
result = app.integrations.bitbucket.update_issue(workspace: "", repo_slug: "", issue_id: 0)
```
---

## Multi-Account Usage

If you have multiple bitbucket accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
# Discover the exact function and required parameters with code_read_doc.
# Explicit default (portable across setups)
# Discover the exact function and required parameters with code_read_doc.
# Named accounts
# Discover the exact function and required parameters with code_read_doc.
# Discover the exact function and required parameters with code_read_doc.
```
All functions are identical across accounts — only the credentials differ.
