# GitHub — JavaScript API Reference

## Overview

The GitHub integration provides full access to repositories, issues, pull requests, commits, files, branches, releases, gists, and GitHub Actions workflows. All 30 tools are available under the `app.integrations.github` namespace.

Every tool call accepts a single JavaScript object with named parameters and returns a JavaScript object with the API response data.

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

```js
// All calls use the same namespace — no per-call auth needed
var repos = app.integrations.github.list_repos({})
```
## Repositories

### `app.integrations.github.list_repos({})`

List repositories for the authenticated user.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| *(none)* | — | — | Takes no parameters |

```js
var repos = app.integrations.github.list_repos({})

for (const repo of (repos)) {
  console.log(repo.full_name + " (★ " + repo.stargazers_count + ")")
}
```
### `app.integrations.github.get_repo({ owner, repo })`

Get details for a specific repository.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner (user or org) |
| `repo` | string | yes | Repository name |

```js
var repo = app.integrations.github.get_repo({
  owner: "octocat",
  repo: "Hello-World",
})

console.log(repo.description)
console.log("Default branch: " + repo.default_branch)
console.log("Stars: " + repo.stargazers_count)
```
### `app.integrations.github.create_repo({ name, description, private })`

Create a new repository for the authenticated user.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Repository name |
| `description` | string | no | Short description |
| `private` | boolean | no | `true` for private, `false` (default) for public |

```js
var repo = app.integrations.github.create_repo({
  name: "my-new-project",
  description: "A brand new project",
  private: true,
})

console.log("Created: " + repo.full_name)
console.log("URL: " + repo.html_url)
```
### `app.integrations.github.search_repos({ query })`

Search for repositories on GitHub.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | Search query (supports GitHub search syntax) |

```js
var results = app.integrations.github.search_repos({
  query: "lua language:lua stars:>1000",
})

for (const item of (results.items)) {
  console.log(item.full_name + " — " + item.description)
}
```
## Issues

### `app.integrations.github.list_issues({ owner, repo })`

List issues in a repository.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |

```js
var issues = app.integrations.github.list_issues({
  owner: "octocat",
  repo: "Hello-World",
})

for (const issue of (issues)) {
  console.log("#" + issue.number + ": " + issue.title + " [" + issue.state + "]")
}
```
### `app.integrations.github.get_issue({ owner, repo, issue_number })`

Get details for a specific issue.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |
| `issue_number` | integer | yes | Issue number |

```js
var issue = app.integrations.github.get_issue({
  owner: "octocat",
  repo: "Hello-World",
  issue_number: 42,
})

console.log(issue.title)
console.log("State: " + issue.state)
console.log("Created by: " + issue.user.login)
console.log("Labels: " + issue.labels.length)
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

```js
var issue = app.integrations.github.create_issue({
  owner: "octocat",
  repo: "Hello-World",
  title: "Bug: Login page crashes on mobile",
  body: "## Steps to reproduce\n1. Open the login page on mobile\n2. Enter credentials\n3. App crashes",
  assignees: [ "octocat", "contributor" ],
  labels: [ "bug", "mobile", "priority:high" ],
})

console.log("Created issue #" + issue.number)
console.log(issue.html_url)
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

```js
// Close an issue
var issue = app.integrations.github.update_issue({
  owner: "octocat",
  repo: "Hello-World",
  issue_number: 42,
  state: "closed",
})

// Update title and add labels
var issue = app.integrations.github.update_issue({
  owner: "octocat",
  repo: "Hello-World",
  issue_number: 15,
  title: "Bug: Login page crashes (resolved)",
  labels: [ "bug", "fixed" ],
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

```js
var labels = app.integrations.github.add_labels({
  owner: "octocat",
  repo: "Hello-World",
  issue_number: 42,
  labels: [ "enhancement", "help-wanted" ],
})

for (const label of (labels)) {
  console.log(label.name + " (" + label.color + ")")
}
```
### `app.integrations.github.create_issue_comment({ owner, repo, issue_number, body })`

Add a comment to an issue or pull request.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |
| `issue_number` | integer | yes | Issue or PR number |
| `body` | string | yes | Comment body (Markdown supported) |

```js
var comment = app.integrations.github.create_issue_comment({
  owner: "octocat",
  repo: "Hello-World",
  issue_number: 42,
  body: "This has been fixed in #50. Closing.",
})

console.log("Comment URL: " + comment.html_url)
```
## Pull Requests

### `app.integrations.github.list_pull_requests({ owner, repo, state })`

List pull requests in a repository.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |
| `state` | string | no | Filter by state: `"open"`, `"closed"`, `"all"` (default: `"open"`) |

```js
var prs = app.integrations.github.list_pull_requests({
  owner: "octocat",
  repo: "Hello-World",
  state: "open",
})

for (const pr of (prs)) {
  console.log("#" + pr.number + ": " + pr.title + " (" + pr.user.login + ")")
}
```
### `app.integrations.github.get_pull_request({ owner, repo, pull_number })`

Get details for a specific pull request.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |
| `pull_number` | integer | yes | Pull request number |

```js
var pr = app.integrations.github.get_pull_request({
  owner: "octocat",
  repo: "Hello-World",
  pull_number: 12,
})

console.log(pr.title)
console.log("Branch: " + pr.head.ref + " → " + pr.base.ref)
console.log("Mergeable: " + String(pr.mergeable))
console.log("Additions: +" + pr.additions + " Deletions: -" + pr.deletions)
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

```js
var pr = app.integrations.github.create_pull_request({
  owner: "octocat",
  repo: "Hello-World",
  title: "Add new authentication module",
  head: "feature/auth",
  base: "main",
  body: "## Changes\n- Added OAuth2 support\n- Updated login flow\n- Added unit tests",
})

console.log("Created PR #" + pr.number)
console.log(pr.html_url)
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

```js
// Close a PR without merging
var pr = app.integrations.github.update_pull_request({
  owner: "octocat",
  repo: "Hello-World",
  pull_number: 12,
  state: "closed",
})

// Update PR title and description
var pr = app.integrations.github.update_pull_request({
  owner: "octocat",
  repo: "Hello-World",
  pull_number: 12,
  title: "Add auth module (revised)",
  body: "Updated implementation based on review feedback.",
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

```js
var result = app.integrations.github.merge_pull_request({
  owner: "octocat",
  repo: "Hello-World",
  pull_number: 12,
  commit_message: "Merge feature/auth into main",
})

if (result.merged) {
  console.log("Merged! SHA: " + result.sha)
} else {
  console.log("Not merged: " + result.message)
}
```
### `app.integrations.github.list_pull_request_reviews({ owner, repo, pull_number })`

List reviews on a pull request.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |
| `pull_number` | integer | yes | Pull request number |

```js
var reviews = app.integrations.github.list_pull_request_reviews({
  owner: "octocat",
  repo: "Hello-World",
  pull_number: 12,
})

for (const review of (reviews)) {
  console.log(review.user.login + ": " + review.state)
  // States: "APPROVED", "CHANGES_REQUESTED", "COMMENTED", "PENDING", "DISMISSED"
}
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

```js
// Approve a PR
var review = app.integrations.github.create_review({
  owner: "octocat",
  repo: "Hello-World",
  pull_number: 12,
  body: "Looks good to me! Clean implementation.",
  event: "APPROVE",
})

// Request changes
var review = app.integrations.github.create_review({
  owner: "octocat",
  repo: "Hello-World",
  pull_number: 12,
  body: "Please add more test coverage for the auth module.",
  event: "REQUEST_CHANGES",
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

```js
var commits = app.integrations.github.list_commits({
  owner: "octocat",
  repo: "Hello-World",
})

for (const commit of (commits)) {
  console.log(commit.sha.slice(1 - 1, 7) + " " + commit.commit.message.match("^[^\n]+")?.[0])
  console.log("  by " + commit.commit.author.name)
}
```
Filter by file path:

```js
var commits = app.integrations.github.list_commits({
  owner: "octocat",
  repo: "Hello-World",
  path: "src/auth.lua",
})

console.log("Commits touching src/auth.lua: " + commits.length)
```
### `app.integrations.github.get_commit({ owner, repo, ref })`

Get details for a specific commit.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |
| `ref` | string | yes | Commit SHA or ref |

```js
var commit = app.integrations.github.get_commit({
  owner: "octocat",
  repo: "Hello-World",
  ref: "a1b2c3d4e5f6",
})

console.log("Message: " + commit.commit.message)
console.log("Author: " + commit.commit.author.name)
console.log("Files changed: " + commit.files.length)
for (const file of (commit.files)) {
  console.log("  " + file.filename + " (+" + file.additions + " / -" + file.deletions + ")")
}
```
### `app.integrations.github.get_file_content({ owner, repo, path, ref })`

Get the content of a file from a repository. Returns the file content (base64-decoded for binary, plain text for text files).

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |
| `path` | string | yes | File path in the repository |
| `ref` | string | no | Branch, tag, or SHA (default: default branch) |

```js
var file = app.integrations.github.get_file_content({
  owner: "octocat",
  repo: "Hello-World",
  path: "README.md",
  ref: "main",
})

console.log("Content:\n" + file.content)
console.log("Encoding: " + file.encoding)
console.log("Size: " + file.size + " bytes")
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

```js
// Create a new file
var result = app.integrations.github.create_or_update_file({
  owner: "octocat",
  repo: "Hello-World",
  path: "docs/api-reference.md",
  message: "Add API reference documentation",
  content: "# API Reference\n\n## Endpoints\n...",
  branch: "main",
})

console.log("Committed: " + result.commit.sha)
```
```js
// Update an existing file (requires current SHA)
var file = app.integrations.github.get_file_content({
  owner: "octocat",
  repo: "Hello-World",
  path: "README.md",
  ref: "main",
})

var result = app.integrations.github.create_or_update_file({
  owner: "octocat",
  repo: "Hello-World",
  path: "README.md",
  message: "Update project description",
  content: "# Hello World\n\nUpdated project description.",
  branch: "main",
  sha: file.sha,
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

```js
var result = app.integrations.github.create_branch({
  owner: "octocat",
  repo: "Hello-World",
  ref: "main",
  branch: "feature/new-api",
})

console.log("Created branch: " + result.ref)
console.log("SHA: " + result.object.sha)
```
### `app.integrations.github.list_branches({ owner, repo })`

List branches in a repository.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |

```js
var branches = app.integrations.github.list_branches({
  owner: "octocat",
  repo: "Hello-World",
})

for (const branch of (branches)) {
  console.log(branch.name)
}
```
## Releases

### `app.integrations.github.list_releases({ owner, repo })`

List releases in a repository.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |

```js
var releases = app.integrations.github.list_releases({
  owner: "octocat",
  repo: "Hello-World",
})

for (const release of (releases)) {
  console.log(release.tag_name + ": " + release.name)
  console.log("  Draft: " + String(release.draft) + " Prerelease: " + String(release.prerelease))
  console.log("  Published: " + release.published_at)
}
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

```js
var release = app.integrations.github.create_release({
  owner: "octocat",
  repo: "Hello-World",
  tag_name: "v2.0.0",
  name: "Version 2.0.0",
  body: "## What's new\n\n- New authentication module\n- Performance improvements\n- Bug fixes",
  draft: false,
  prerelease: false,
})

console.log("Release URL: " + release.html_url)
console.log("Tag: " + release.tag_name)
```
## Search & Other

### `app.integrations.github.search_issues({ query })`

Search for issues and pull requests across GitHub using the GitHub Search API.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | GitHub search query (supports qualifiers like `is:issue`, `is:pr`, `repo:`, `label:`, etc.) |

```js
// Search for open issues in a specific repo
var results = app.integrations.github.search_issues({
  query: "is:issue is:open repo:octocat/Hello-World label:bug",
})

for (const item of (results.items)) {
  console.log("#" + item.number + ": " + item.title)
}
```
```js
// Search across all your repos
var results = app.integrations.github.search_issues({
  query: "is:open involves:octocat sort:updated-desc",
})

console.log("Total results: " + results.total_count)
```
### `app.integrations.github.get_current_user({})`

Get the authenticated user's profile. Useful to verify credentials and discover the username.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| *(none)* | — | — | Takes no parameters |

```js
var user = app.integrations.github.get_current_user({})

console.log("Username: " + user.login)
console.log("Name: " + user.name)
console.log("Email: " + user.email)
console.log("Public repos: " + user.public_repos)
```
### `app.integrations.github.create_gist({ description, public, files })`

Create a new GitHub gist.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `description` | string | no | Gist description |
| `public` | boolean | no | `true` for public gist, `false` for secret (default: `true`) |
| `files` | table | yes | Table of files — keys are filenames, values contain `content` |

```js
var gist = app.integrations.github.create_gist({
  description: "JavaScript utility functions",
  public: true,
  files: {
    ["utils.lua"]: {
      content: 'local M = {}\nfunction M.hello(name)\n  return "Hello, " + name\nend\nreturn M',
    },
    ["README.md"]: {
      content: "# Utils\n\nA collection of JavaScript utility functions.",
    },
  },
})

console.log("Gist URL: " + gist.html_url)
console.log("Git pull URL: " + gist.git_pull_url)
```
### `app.integrations.github.list_workflow_runs({ owner, repo, workflow_id })`

List GitHub Actions workflow runs.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner` | string | yes | Repository owner |
| `repo` | string | yes | Repository name |
| `workflow_id` | string | yes | Workflow ID or filename (e.g. `"ci.yml"`) |

```js
var runs = app.integrations.github.list_workflow_runs({
  owner: "octocat",
  repo: "Hello-World",
  workflow_id: "ci.yml",
})

for (const run of (runs.workflow_runs)) {
  console.log(run.id + ": " + run.status + " / " + (run.conclusion || "pending"))
  console.log("  Branch: " + run.head_branch + " at " + run.created_at)
}
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

```js
// Trigger a deploy workflow
var success = app.integrations.github.dispatch_workflow({
  owner: "octocat",
  repo: "Hello-World",
  workflow_id: "deploy.yml",
  ref: "main",
  inputs: {
    environment: "production",
    version: "2.0.0",
  },
})

if (success) {
  console.log("Workflow triggered successfully")
}
```
## Common Workflows

### Feature branch → PR → merge

```js
var owner = "octocat"
var repo = "Hello-World"

// 1. Create a feature branch
app.integrations.github.create_branch({
  owner: owner,
  repo: repo,
  ref: "main",
  branch: "feature/new-auth",
})

// 2. Create or update a file on the branch
app.integrations.github.create_or_update_file({
  owner: owner,
  repo: repo,
  path: "src/auth.lua",
  message: "Add new authentication module",
  content: "local auth = {}\\nreturn auth",
  branch: "feature/new-auth",
})

// 3. Open a pull request
var pr = app.integrations.github.create_pull_request({
  owner: owner,
  repo: repo,
  title: "Add new authentication module",
  head: "feature/new-auth",
  base: "main",
  body: "Implements the new auth flow.",
})

// 4. Review and approve
app.integrations.github.create_review({
  owner: owner,
  repo: repo,
  pull_number: pr.number,
  body: "Approved — looks clean.",
  event: "APPROVE",
})

// 5. Merge
app.integrations.github.merge_pull_request({
  owner: owner,
  repo: repo,
  pull_number: pr.number,
  commit_message: "Merge feature/new-auth",
})

// 6. Create a release
app.integrations.github.create_release({
  owner: owner,
  repo: repo,
  tag_name: "v1.1.0",
  name: "v1.1.0 — New Auth",
  body: "Adds new authentication module.",
})
```
### Triage issues: search, label, comment, close

```js
var owner = "octocat"
var repo = "Hello-World"

// Find all open bug issues without a priority label
var results = app.integrations.github.search_issues({
  query: "is:issue is:open label:bug -label:priority:high -label:priority:low repo:" + owner + "/" + repo,
})

for (const item of (results.items)) {
  // Add a priority label
  app.integrations.github.add_labels({
    owner: owner,
    repo: repo,
    issue_number: item.number,
    labels: [ "priority:high" ],
  })

  // Comment with triage note
  app.integrations.github.create_issue_comment({
    owner: owner,
    repo: repo,
    issue_number: item.number,
    body: "Triaged as high priority. Will be addressed in the next sprint.",
  })
}
```
### Read a config file, update it, and commit

```js
var owner = "octocat"
var repo = "Hello-World"
var branch = "main"
var path = "config/app.json"

// 1. Read current file (need the SHA for update)
var file = app.integrations.github.get_file_content({
  owner: owner,
  repo: repo,
  path: path,
  ref: branch,
})

// 2. Update and commit
app.integrations.github.create_or_update_file({
  owner: owner,
  repo: repo,
  path: path,
  message: "Update app config: enable new feature flag",
  content: '{"feature_flags": {"new_ui": true, "dark_mode": true}}',
  branch: branch,
  sha: file.sha,
})
```
### Trigger CI and check status

```js
var owner = "octocat"
var repo = "Hello-World"

// Trigger the CI workflow
app.integrations.github.dispatch_workflow({
  owner: owner,
  repo: repo,
  workflow_id: "ci.yml",
  ref: "main",
  inputs: {
    test_suite: "full",
  },
})

// List recent runs to find the status
var runs = app.integrations.github.list_workflow_runs({
  owner: owner,
  repo: repo,
  workflow_id: "ci.yml",
})

var latest = runs.workflow_runs[0]
console.log("Run #" + latest.id + ": " + latest.status)
console.log("Conclusion: " + (latest.conclusion || "pending"))
```
## Pagination

Most list endpoints return arrays directly. The underlying GitHub API paginates with `per_page` (default 30, max 100) and `page` parameters. If you need more results than the default page size, you may need to make multiple calls or adjust pagination parameters if the integration exposes them.

Typical response shapes:

```js
// list_issues, list_pull_requests, list_commits, list_branches → array
var issues = app.integrations.github.list_issues({ owner: "octocat", repo: "Hello-World" })
// issues is a plain JavaScript array: { { number: 1, title: "..."}}

// search_issues, search_repos → table with total_count and items
var results = app.integrations.github.search_repos({ query: "lua" })
// results.total_count = 1234
// results.items = { { full_name: "..."}}

// list_workflow_runs → table with workflow_runs array
var runs = app.integrations.github.list_workflow_runs({ owner: "octocat", repo: "repo", workflow_id: "ci.yml" })
// runs.workflow_runs = { { id: 123, status: "completed"}}
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

```js
// Default account (always works)
app.integrations.github.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.github.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.github.work.function_name({ /* parameters */ })
app.integrations.github.personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
