# GitHub — Lua API Reference

## Overview

The GitHub integration provides full access to repositories, issues, pull requests, commits, files, branches, releases, gists, and GitHub Actions workflows. All 30 tools are available under the `app.integrations.github` namespace.

Every tool call accepts a single Lua table with named parameters and returns a Lua table with the API response data.

## Authentication

The GitHub integration authenticates via a **Personal Access Token** (classic or fine-grained) or **OAuth**. The token is sent as an API key header on every request.

To create a token: **GitHub → Settings → Developer settings → Personal access tokens**

Required scopes depend on the tools you use:

| Scope | Needed for |
|-------|-----------|
| `repo` | Full repository access (issues, PRs, commits, files, branches, releases) |
| `gist` | Creating gists |
| `workflow` | Triggering and listing GitHub Actions workflow runs |
| `read:org` | Listing org repositories |

```lua
-- All calls use the same namespace — no per-call auth needed
local repos = app.integrations.github.list_repos({})
```

## Repositories

### `app.integrations.github.list_repos({})`

List repositories for the authenticated user.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| *(none)* | — | — | Takes no parameters |

```lua
local repos = app.integrations.github.list_repos({})

for _, repo in ipairs(repos) do
  print(repo.full_name .. " (★ " .. repo.stargazers_count .. ")")
end
```

### `app.integrations.github.get_repo({ owner, repo })`

Get details for a specific repository.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner (user or org) |
| `repo` | string | yes | Repository name |

```lua
local repo = app.integrations.github.get_repo({
  owner = "octocat",
  repo = "Hello-World",
})

print(repo.description)
print("Default branch: " .. repo.default_branch)
print("Stars: " .. repo.stargazers_count)
```

### `app.integrations.github.create_repo({ name, description, private })`

Create a new repository for the authenticated user.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Repository name |
| `description` | string | no | Short description |
| `private` | boolean | no | `true` for private, `false` (default) for public |

```lua
local repo = app.integrations.github.create_repo({
  name = "my-new-project",
  description = "A brand new project",
  private = true,
})

print("Created: " .. repo.full_name)
print("URL: " .. repo.html_url)
```

### `app.integrations.github.search_repos({ query })`

Search for repositories on GitHub.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | Search query (supports GitHub search syntax) |

```lua
local results = app.integrations.github.search_repos({
  query = "lua language:lua stars:>1000",
})

for _, item in ipairs(results.items) do
  print(item.full_name .. " — " .. item.description)
end
```

## Issues

### `app.integrations.github.list_issues({ owner, repo })`

List issues in a repository.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |

```lua
local issues = app.integrations.github.list_issues({
  owner = "octocat",
  repo = "Hello-World",
})

for _, issue in ipairs(issues) do
  print("#" .. issue.number .. ": " .. issue.title .. " [" .. issue.state .. "]")
end
```

### `app.integrations.github.get_issue({ owner, repo, issue_number })`

Get details for a specific issue.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |
| `issue_number` | integer | yes | Issue number |

```lua
local issue = app.integrations.github.get_issue({
  owner = "octocat",
  repo = "Hello-World",
  issue_number = 42,
})

print(issue.title)
print("State: " .. issue.state)
print("Created by: " .. issue.user.login)
print("Labels: " .. #issue.labels)
```

### `app.integrations.github.create_issue({ owner, repo, title, body, assignees, labels })`

Create a new issue in a repository.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |
| `title` | string | yes | Issue title |
| `body` | string | no | Issue body (Markdown supported) |
| `assignees` | array | no | List of GitHub usernames to assign |
| `labels` | array | no | List of label names |

```lua
local issue = app.integrations.github.create_issue({
  owner = "octocat",
  repo = "Hello-World",
  title = "Bug: Login page crashes on mobile",
  body = "## Steps to reproduce\n1. Open the login page on mobile\n2. Enter credentials\n3. App crashes",
  assignees = { "octocat", "contributor" },
  labels = { "bug", "mobile", "priority:high" },
})

print("Created issue #" .. issue.number)
print(issue.html_url)
```

### `app.integrations.github.update_issue({ owner, repo, issue_number, title, body, state, assignees, labels })`

Update an existing issue.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |
| `issue_number` | integer | yes | Issue number |
| `title` | string | no | New title |
| `body` | string | no | New body (Markdown) |
| `state` | string | no | `"open"` or `"closed"` |
| `assignees` | array | no | Replace assignees (list of usernames) |
| `labels` | array | no | Replace labels (list of label names) |

```lua
-- Close an issue
local issue = app.integrations.github.update_issue({
  owner = "octocat",
  repo = "Hello-World",
  issue_number = 42,
  state = "closed",
})

-- Update title and add labels
local issue = app.integrations.github.update_issue({
  owner = "octocat",
  repo = "Hello-World",
  issue_number = 15,
  title = "Bug: Login page crashes (resolved)",
  labels = { "bug", "fixed" },
})
```

### `app.integrations.github.add_labels({ owner, repo, issue_number, labels })`

Add labels to an issue (appends without replacing existing labels).

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |
| `issue_number` | integer | yes | Issue number |
| `labels` | array | yes | List of label names to add |

```lua
local labels = app.integrations.github.add_labels({
  owner = "octocat",
  repo = "Hello-World",
  issue_number = 42,
  labels = { "enhancement", "help-wanted" },
})

for _, label in ipairs(labels) do
  print(label.name .. " (" .. label.color .. ")")
end
```

### `app.integrations.github.create_issue_comment({ owner, repo, issue_number, body })`

Add a comment to an issue or pull request.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |
| `issue_number` | integer | yes | Issue or PR number |
| `body` | string | yes | Comment body (Markdown supported) |

```lua
local comment = app.integrations.github.create_issue_comment({
  owner = "octocat",
  repo = "Hello-World",
  issue_number = 42,
  body = "This has been fixed in #50. Closing.",
})

print("Comment URL: " .. comment.html_url)
```

## Pull Requests

### `app.integrations.github.list_pull_requests({ owner, repo, state })`

List pull requests in a repository.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |
| `state` | string | no | Filter by state: `"open"`, `"closed"`, `"all"` (default: `"open"`) |

```lua
local prs = app.integrations.github.list_pull_requests({
  owner = "octocat",
  repo = "Hello-World",
  state = "open",
})

for _, pr in ipairs(prs) do
  print("#" .. pr.number .. ": " .. pr.title .. " (" .. pr.user.login .. ")")
end
```

### `app.integrations.github.get_pull_request({ owner, repo, pull_number })`

Get details for a specific pull request.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |
| `pull_number` | integer | yes | Pull request number |

```lua
local pr = app.integrations.github.get_pull_request({
  owner = "octocat",
  repo = "Hello-World",
  pull_number = 12,
})

print(pr.title)
print("Branch: " .. pr.head.ref .. " → " .. pr.base.ref)
print("Mergeable: " .. tostring(pr.mergeable))
print("Additions: +" .. pr.additions .. " Deletions: -" .. pr.deletions)
```

### `app.integrations.github.create_pull_request({ owner, repo, title, head, base, body })`

Create a new pull request.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |
| `title` | string | yes | PR title |
| `head` | string | yes | Source branch name |
| `base` | string | yes | Target branch name |
| `body` | string | no | PR description (Markdown supported) |

```lua
local pr = app.integrations.github.create_pull_request({
  owner = "octocat",
  repo = "Hello-World",
  title = "Add new authentication module",
  head = "feature/auth",
  base = "main",
  body = "## Changes\n- Added OAuth2 support\n- Updated login flow\n- Added unit tests",
})

print("Created PR #" .. pr.number)
print(pr.html_url)
```

### `app.integrations.github.update_pull_request({ owner, repo, pull_number, title, body, state })`

Update an existing pull request.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |
| `pull_number` | integer | yes | Pull request number |
| `title` | string | no | New title |
| `body` | string | no | New description |
| `state` | string | no | `"open"` or `"closed"` |

```lua
-- Close a PR without merging
local pr = app.integrations.github.update_pull_request({
  owner = "octocat",
  repo = "Hello-World",
  pull_number = 12,
  state = "closed",
})

-- Update PR title and description
local pr = app.integrations.github.update_pull_request({
  owner = "octocat",
  repo = "Hello-World",
  pull_number = 12,
  title = "Add auth module (revised)",
  body = "Updated implementation based on review feedback.",
})
```

### `app.integrations.github.merge_pull_request({ owner, repo, pull_number, commit_message })`

Merge a pull request.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |
| `pull_number` | integer | yes | Pull request number |
| `commit_message` | string | no | Custom merge commit message |

```lua
local result = app.integrations.github.merge_pull_request({
  owner = "octocat",
  repo = "Hello-World",
  pull_number = 12,
  commit_message = "Merge feature/auth into main",
})

if result.merged then
  print("Merged! SHA: " .. result.sha)
else
  print("Not merged: " .. result.message)
end
```

### `app.integrations.github.list_pull_request_reviews({ owner, repo, pull_number })`

List reviews on a pull request.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |
| `pull_number` | integer | yes | Pull request number |

```lua
local reviews = app.integrations.github.list_pull_request_reviews({
  owner = "octocat",
  repo = "Hello-World",
  pull_number = 12,
})

for _, review in ipairs(reviews) do
  print(review.user.login .. ": " .. review.state)
  -- States: "APPROVED", "CHANGES_REQUESTED", "COMMENTED", "PENDING", "DISMISSED"
end
```

### `app.integrations.github.create_review({ owner, repo, pull_number, body, event })`

Create a review on a pull request.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |
| `pull_number` | integer | yes | Pull request number |
| `body` | string | no | Review comment body |
| `event` | string | no | Review action: `"APPROVE"`, `"REQUEST_CHANGES"`, `"COMMENT"` |

```lua
-- Approve a PR
local review = app.integrations.github.create_review({
  owner = "octocat",
  repo = "Hello-World",
  pull_number = 12,
  body = "Looks good to me! Clean implementation.",
  event = "APPROVE",
})

-- Request changes
local review = app.integrations.github.create_review({
  owner = "octocat",
  repo = "Hello-World",
  pull_number = 12,
  body = "Please add more test coverage for the auth module.",
  event = "REQUEST_CHANGES",
})
```

## Commits & Files

### `app.integrations.github.list_commits({ owner, repo, sha, path })`

List commits in a repository.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |
| `sha` | string | no | Branch or SHA to list commits from (default: default branch) |
| `path` | string | no | Filter commits to those touching this file path |

```lua
local commits = app.integrations.github.list_commits({
  owner = "octocat",
  repo = "Hello-World",
})

for _, commit in ipairs(commits) do
  print(commit.sha:sub(1, 7) .. " " .. commit.commit.message:match("^[^\n]+"))
  print("  by " .. commit.commit.author.name)
end
```

Filter by file path:

```lua
local commits = app.integrations.github.list_commits({
  owner = "octocat",
  repo = "Hello-World",
  path = "src/auth.lua",
})

print("Commits touching src/auth.lua: " .. #commits)
```

### `app.integrations.github.get_commit({ owner, repo, ref })`

Get details for a specific commit.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |
| `ref` | string | yes | Commit SHA or ref |

```lua
local commit = app.integrations.github.get_commit({
  owner = "octocat",
  repo = "Hello-World",
  ref = "a1b2c3d4e5f6",
})

print("Message: " .. commit.commit.message)
print("Author: " .. commit.commit.author.name)
print("Files changed: " .. #commit.files)
for _, file in ipairs(commit.files) do
  print("  " .. file.filename .. " (+" .. file.additions .. " / -" .. file.deletions .. ")")
end
```

### `app.integrations.github.get_file_content({ owner, repo, path, ref })`

Get the content of a file from a repository. Returns the file content (base64-decoded for binary, plain text for text files).

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |
| `path` | string | yes | File path in the repository |
| `ref` | string | no | Branch, tag, or SHA (default: default branch) |

```lua
local file = app.integrations.github.get_file_content({
  owner = "octocat",
  repo = "Hello-World",
  path = "README.md",
  ref = "main",
})

print("Content:\n" .. file.content)
print("Encoding: " .. file.encoding)
print("Size: " .. file.size .. " bytes")
```

### `app.integrations.github.create_or_update_file({ owner, repo, path, message, content, branch, sha })`

Create or update a file in a repository. When updating an existing file, you must provide the current file's `sha` (obtained from `get_file_content`).

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |
| `path` | string | yes | File path in the repository |
| `message` | string | yes | Commit message |
| `content` | string | yes | File content (will be base64-encoded automatically) |
| `branch` | string | yes | Target branch |
| `sha` | string | no | Required when updating an existing file (the blob SHA) |

```lua
-- Create a new file
local result = app.integrations.github.create_or_update_file({
  owner = "octocat",
  repo = "Hello-World",
  path = "docs/api-reference.md",
  message = "Add API reference documentation",
  content = "# API Reference\n\n## Endpoints\n...",
  branch = "main",
})

print("Committed: " .. result.commit.sha)
```

```lua
-- Update an existing file (requires current SHA)
local file = app.integrations.github.get_file_content({
  owner = "octocat",
  repo = "Hello-World",
  path = "README.md",
  ref = "main",
})

local result = app.integrations.github.create_or_update_file({
  owner = "octocat",
  repo = "Hello-World",
  path = "README.md",
  message = "Update project description",
  content = "# Hello World\n\nUpdated project description.",
  branch = "main",
  sha = file.sha,
})
```

## Branches

### `app.integrations.github.create_branch({ owner, repo, ref, branch })`

Create a new branch from an existing ref.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |
| `ref` | string | yes | Source branch or SHA to branch from |
| `branch` | string | yes | Name for the new branch |

```lua
local result = app.integrations.github.create_branch({
  owner = "octocat",
  repo = "Hello-World",
  ref = "main",
  branch = "feature/new-api",
})

print("Created branch: " .. result.ref)
print("SHA: " .. result.object.sha)
```

### `app.integrations.github.list_branches({ owner, repo })`

List branches in a repository.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |

```lua
local branches = app.integrations.github.list_branches({
  owner = "octocat",
  repo = "Hello-World",
})

for _, branch in ipairs(branches) do
  print(branch.name)
end
```

## Releases

### `app.integrations.github.list_releases({ owner, repo })`

List releases in a repository.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |

```lua
local releases = app.integrations.github.list_releases({
  owner = "octocat",
  repo = "Hello-World",
})

for _, release in ipairs(releases) do
  print(release.tag_name .. ": " .. release.name)
  print("  Draft: " .. tostring(release.draft) .. " Prerelease: " .. tostring(release.prerelease))
  print("  Published: " .. release.published_at)
end
```

### `app.integrations.github.create_release({ owner, repo, tag_name, name, body, draft, prerelease })`

Create a new release (and optionally a tag).

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |
| `tag_name` | string | yes | Tag name for the release (e.g. `"v1.2.0"`) |
| `name` | string | no | Release title |
| `body` | string | no | Release notes (Markdown supported) |
| `draft` | boolean | no | `true` to create as draft (default: `false`) |
| `prerelease` | boolean | no | `true` to mark as prerelease (default: `false`) |

```lua
local release = app.integrations.github.create_release({
  owner = "octocat",
  repo = "Hello-World",
  tag_name = "v2.0.0",
  name = "Version 2.0.0",
  body = "## What's new\n\n- New authentication module\n- Performance improvements\n- Bug fixes",
  draft = false,
  prerelease = false,
})

print("Release URL: " .. release.html_url)
print("Tag: " .. release.tag_name)
```

## Search & Other

### `app.integrations.github.search_issues({ query })`

Search for issues and pull requests across GitHub using the GitHub Search API.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | GitHub search query (supports qualifiers like `is:issue`, `is:pr`, `repo:`, `label:`, etc.) |

```lua
-- Search for open issues in a specific repo
local results = app.integrations.github.search_issues({
  query = "is:issue is:open repo:octocat/Hello-World label:bug",
})

for _, item in ipairs(results.items) do
  print("#" .. item.number .. ": " .. item.title)
end
```

```lua
-- Search across all your repos
local results = app.integrations.github.search_issues({
  query = "is:open involves:octocat sort:updated-desc",
})

print("Total results: " .. results.total_count)
```

### `app.integrations.github.get_current_user({})`

Get the authenticated user's profile. Useful to verify credentials and discover the username.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| *(none)* | — | — | Takes no parameters |

```lua
local user = app.integrations.github.get_current_user({})

print("Username: " .. user.login)
print("Name: " .. user.name)
print("Email: " .. user.email)
print("Public repos: " .. user.public_repos)
```

### `app.integrations.github.create_gist({ description, public, files })`

Create a new GitHub gist.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `description` | string | no | Gist description |
| `public` | boolean | no | `true` for public gist, `false` for secret (default: `true`) |
| `files` | table | yes | Table of files — keys are filenames, values contain `content` |

```lua
local gist = app.integrations.github.create_gist({
  description = "Lua utility functions",
  public = true,
  files = {
    ["utils.lua"] = {
      content = 'local M = {}\nfunction M.hello(name)\n  return "Hello, " .. name\nend\nreturn M',
    },
    ["README.md"] = {
      content = "# Utils\n\nA collection of Lua utility functions.",
    },
  },
})

print("Gist URL: " .. gist.html_url)
print("Git pull URL: " .. gist.git_pull_url)
```

### `app.integrations.github.list_workflow_runs({ owner, repo, workflow_id })`

List GitHub Actions workflow runs.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |
| `workflow_id` | string | yes | Workflow ID or filename (e.g. `"ci.yml"`) |

```lua
local runs = app.integrations.github.list_workflow_runs({
  owner = "octocat",
  repo = "Hello-World",
  workflow_id = "ci.yml",
})

for _, run in ipairs(runs.workflow_runs) do
  print(run.id .. ": " .. run.status .. " / " .. (run.conclusion or "pending"))
  print("  Branch: " .. run.head_branch .. " at " .. run.created_at)
end
```

### `app.integrations.github.dispatch_workflow({ owner, repo, workflow_id, ref, inputs })`

Trigger a GitHub Actions workflow run using the `workflow_dispatch` event.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |
| `workflow_id` | string | yes | Workflow ID or filename (e.g. `"deploy.yml"`) |
| `ref` | string | yes | Branch or tag to run the workflow on |
| `inputs` | table | no | Key-value pairs matching the workflow's `workflow_dispatch` inputs |

```lua
-- Trigger a deploy workflow
local success = app.integrations.github.dispatch_workflow({
  owner = "octocat",
  repo = "Hello-World",
  workflow_id = "deploy.yml",
  ref = "main",
  inputs = {
    environment = "production",
    version = "2.0.0",
  },
})

if success then
  print("Workflow triggered successfully")
end
```

## Common Workflows

### Feature branch → PR → merge

```lua
local owner = "octocat"
local repo = "Hello-World"

-- 1. Create a feature branch
app.integrations.github.create_branch({
  owner = owner,
  repo = repo,
  ref = "main",
  branch = "feature/new-auth",
})

-- 2. Create or update a file on the branch
app.integrations.github.create_or_update_file({
  owner = owner,
  repo = repo,
  path = "src/auth.lua",
  message = "Add new authentication module",
  content = "local auth = {}\\nreturn auth",
  branch = "feature/new-auth",
})

-- 3. Open a pull request
local pr = app.integrations.github.create_pull_request({
  owner = owner,
  repo = repo,
  title = "Add new authentication module",
  head = "feature/new-auth",
  base = "main",
  body = "Implements the new auth flow.",
})

-- 4. Review and approve
app.integrations.github.create_review({
  owner = owner,
  repo = repo,
  pull_number = pr.number,
  body = "Approved — looks clean.",
  event = "APPROVE",
})

-- 5. Merge
app.integrations.github.merge_pull_request({
  owner = owner,
  repo = repo,
  pull_number = pr.number,
  commit_message = "Merge feature/new-auth",
})

-- 6. Create a release
app.integrations.github.create_release({
  owner = owner,
  repo = repo,
  tag_name = "v1.1.0",
  name = "v1.1.0 — New Auth",
  body = "Adds new authentication module.",
})
```

### Triage issues: search, label, comment, close

```lua
local owner = "octocat"
local repo = "Hello-World"

-- Find all open bug issues without a priority label
local results = app.integrations.github.search_issues({
  query = "is:issue is:open label:bug -label:priority:high -label:priority:low repo:" .. owner .. "/" .. repo,
})

for _, item in ipairs(results.items) do
  -- Add a priority label
  app.integrations.github.add_labels({
    owner = owner,
    repo = repo,
    issue_number = item.number,
    labels = { "priority:high" },
  })

  -- Comment with triage note
  app.integrations.github.create_issue_comment({
    owner = owner,
    repo = repo,
    issue_number = item.number,
    body = "Triaged as high priority. Will be addressed in the next sprint.",
  })
end
```

### Read a config file, update it, and commit

```lua
local owner = "octocat"
local repo = "Hello-World"
local branch = "main"
local path = "config/app.json"

-- 1. Read current file (need the SHA for update)
local file = app.integrations.github.get_file_content({
  owner = owner,
  repo = repo,
  path = path,
  ref = branch,
})

-- 2. Update and commit
app.integrations.github.create_or_update_file({
  owner = owner,
  repo = repo,
  path = path,
  message = "Update app config: enable new feature flag",
  content = '{"feature_flags": {"new_ui": true, "dark_mode": true}}',
  branch = branch,
  sha = file.sha,
})
```

### Trigger CI and check status

```lua
local owner = "octocat"
local repo = "Hello-World"

-- Trigger the CI workflow
app.integrations.github.dispatch_workflow({
  owner = owner,
  repo = repo,
  workflow_id = "ci.yml",
  ref = "main",
  inputs = {
    test_suite = "full",
  },
})

-- List recent runs to find the status
local runs = app.integrations.github.list_workflow_runs({
  owner = owner,
  repo = repo,
  workflow_id = "ci.yml",
})

local latest = runs.workflow_runs[1]
print("Run #" .. latest.id .. ": " .. latest.status)
print("Conclusion: " .. (latest.conclusion or "pending"))
```

## Pagination

Most list endpoints return arrays directly. The underlying GitHub API paginates with `per_page` (default 30, max 100) and `page` parameters. If you need more results than the default page size, you may need to make multiple calls or adjust pagination parameters if the integration exposes them.

Typical response shapes:

```lua
-- list_issues, list_pull_requests, list_commits, list_branches → array
local issues = app.integrations.github.list_issues({ owner = "octocat", repo = "Hello-World" })
-- issues is a plain Lua array: { { number = 1, title = "...", ... }, ... }

-- search_issues, search_repos → table with total_count and items
local results = app.integrations.github.search_repos({ query = "lua" })
-- results.total_count = 1234
-- results.items = { { full_name = "...", ... }, ... }

-- list_workflow_runs → table with workflow_runs array
local runs = app.integrations.github.list_workflow_runs({ owner = "octocat", repo = "repo", workflow_id = "ci.yml" })
-- runs.workflow_runs = { { id = 123, status = "completed", ... }, ... }
```

## Notes

- **Rate limits**: GitHub API rate limits apply (5,000 requests/hour for authenticated users). Exceeding the limit returns HTTP 403.
- **Owner vs. org**: The `owner` parameter accepts both usernames and organization names.
- **Markdown support**: `body` fields in issues, PRs, comments, and releases all support GitHub Flavored Markdown.
- **SHA requirement**: When updating a file with `create_or_update_file`, you must first call `get_file_content` to obtain the current blob SHA. Omitting `sha` will attempt to create a new file.
- **Branch protection**: Merging a PR or pushing to a protected branch may fail if branch protection rules are in effect.
- **Workflow dispatch**: The `dispatch_workflow` tool only works with workflows that have a `workflow_dispatch` trigger defined in their YAML file.
- **Labels**: `add_labels` appends labels to an issue. `update_issue` with `labels` replaces all labels. Use the appropriate tool for your use case.
- **Issue vs. PR comments**: Both use the same `create_issue_comment` tool — PRs are a type of issue in the GitHub API, so `issue_number` accepts either an issue number or a PR number.

---

## Multi-Account Usage

If you have multiple github accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.github.function_name({...})

-- Explicit default (portable across setups)
app.integrations.github.default.function_name({...})

-- Named accounts
app.integrations.github.work.function_name({...})
app.integrations.github.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
