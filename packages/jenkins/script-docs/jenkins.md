# Jenkins — Ruby API Reference

## Overview

The Jenkins integration provides access to CI/CD jobs, builds, nodes (agents), and user information. All 7 tools are available under the `app.integrations.jenkins` namespace.

Every tool call accepts a single Ruby object with named parameters and returns a Ruby object with the API response data.

## Authentication

The Jenkins integration authenticates via a **Bearer token** (API token). The token is sent as an Authorization header on every request.

To create an API token: **Jenkins → User → Configure → API Token**

```ruby
# All calls use the same namespace — no per-call auth needed
jobs = app.integrations.jenkins.list_jobs()
```
## Jobs

### `app.integrations.jenkins.list_jobs({})`

List all Jenkins jobs.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| *(none)* | — | — | Takes no parameters |

```ruby
jobs = app.integrations.jenkins.list_jobs()
jobs.each do |job|
  puts((job.name).to_s + " — " + ((job.color || "unknown")).to_s)
end
```
### `app.integrations.jenkins.get_job({ job_name })`

Get details for a specific Jenkins job.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `job_name` | string | yes | The name of the Jenkins job |

```ruby
job = app.integrations.jenkins.get_job(job_name: "my-project-build")
puts(job.displayName)
puts("Description: " + ((job.description || "none")).to_s)
puts("Last build: " + (((job.lastBuild && job.lastBuild.number) || "none")).to_s)
puts("Health: " + ((((job.healthReport && job.healthReport[0]) && job.healthReport[0].score) || "N/A")).to_s)
```
### `app.integrations.jenkins.create_job({ name, mode, description, config })`

Create a new Jenkins job.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The name for the new job |
| `mode` | string | no | Job type: `freestyle`, `pipeline`, `maven`, `matrix`, or `multibranch` (default: `freestyle`) |
| `description` | string | no | A description for the job |
| `config` | table | no | Job configuration as a structured object |

```ruby
job = app.integrations.jenkins.create_job(name: "my-new-pipeline", mode: "pipeline", description: "Build && test the main branch", config: {scm: {git: {url: "https://github.com/example/repo.git", branch: "main"}}, triggers: {scm: {cron: "H/5 * * * *"}}})
puts("Created job: " + (job.name).to_s)
puts("URL: " + (job.url).to_s)
```
## Builds

### `app.integrations.jenkins.list_builds({ job_name, status })`

List builds for a specific Jenkins job.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `job_name` | string | yes | The name of the Jenkins job |
| `status` | string | no | Filter by status: `SUCCESS`, `FAILURE`, `UNSTABLE`, `ABORTED`, `IN_PROGRESS` |
| `per_page` | integer | no | Number of builds to return (default: 20) |

```ruby
builds = app.integrations.jenkins.list_builds(job_name: "my-project-build")
builds.each do |build|
  puts("#" + (build.number).to_s + " — " + (build.result).to_s + " (" + (build.duration).to_s + "ms)")
end
```
Filter by failed builds:

```ruby
failures = app.integrations.jenkins.list_builds(job_name: "my-project-build", status: "FAILURE")
puts("Failed builds: " + (failures.length).to_s)
```
### `app.integrations.jenkins.get_build({ job_name, build_number })`

Get details for a specific build.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `job_name` | string | yes | The name of the Jenkins job |
| `build_number` | integer | yes | The build number |

```ruby
build = app.integrations.jenkins.get_build(job_name: "my-project-build", build_number: 42)
puts("Build #" + (build.number).to_s)
puts("Result: " + (build.result).to_s)
puts("Duration: " + (build.duration).to_s + "ms")
puts("Started: " + (build.timestamp).to_s)
puts("URL: " + (build.url).to_s)
# Artifacts
if build.artifacts
  build.artifacts.each do |artifact|
    puts("  Artifact: " + (artifact.fileName).to_s)
  end
end
# Change sets
if build.changeSets
  build.changeSets.each do |cs|
    (cs.items || []).each do |item|
      puts("  Commit: " + (item.msg).to_s + " by " + (item.author.fullName).to_s)
    end
  end
end
```
## Nodes

### `app.integrations.jenkins.list_nodes({})`

List all Jenkins nodes (agents).

| Name | Type | Required | Description |
|------|------|----------|-------------|
| *(none)* | — | — | Takes no parameters |

```ruby
nodes = app.integrations.jenkins.list_nodes()
nodes.each do |node|
  status = ((node.offline && "OFFLINE") || "ONLINE")
  puts((node.displayName).to_s + " — " + (status).to_s + " (executors: " + (node.numExecutors).to_s + ")")
end
```
## User

### `app.integrations.jenkins.get_current_user({})`

Get the authenticated Jenkins user's profile. Useful to verify credentials and discover the username.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| *(none)* | — | — | Takes no parameters |

```ruby
user = app.integrations.jenkins.get_current_user()
puts("ID: " + (user.id).to_s)
puts("Name: " + ((user.fullName || "N/A")).to_s)
puts("Email: " + (((user.property && user.property.email) || "N/A")).to_s)
```
## Common Workflows

### Check build status and diagnose failures

```ruby
job_name = "my-project-build"
# 1. Get the job to find the last build number
job = app.integrations.jenkins.get_job(job_name: job_name)
if job.lastBuild
  build = app.integrations.jenkins.get_build(job_name: job_name, build_number: job.lastBuild.number)
  puts("Last build: #" + (build.number).to_s + " — " + (build.result).to_s)
  if (build.result == "FAILURE")
    puts("Build failed! Duration: " + (build.duration).to_s + "ms")
  end
else
  puts("No builds found for this job.")
end
```
### Monitor all jobs and report health

```ruby
jobs = app.integrations.jenkins.list_jobs()
jobs.each do |job|
  detail = app.integrations.jenkins.get_job(job_name: job.name)
  health = ((detail.healthReport && detail.healthReport[0]) || {})
  puts(job.name)
  puts("  Health: " + ((health.score || "N/A")).to_s + "/100")
  puts("  " + ((health.description || "No health report")).to_s)
  if detail.lastBuild
    puts("  Last build: #" + (detail.lastBuild.number).to_s)
  end
end
```
### Create a pipeline job and verify

```ruby
# 1. Create the job
job = app.integrations.jenkins.create_job(name: "deploy-production", mode: "pipeline", description: "Deploy to production environment")
# 2. Verify it was created
detail = app.integrations.jenkins.get_job(job_name: "deploy-production")
puts("Job created: " + (detail.displayName).to_s)
puts("Description: " + ((detail.description || "")).to_s)
```
### Check node availability

```ruby
nodes = app.integrations.jenkins.list_nodes()
offline_count = 0
nodes.each do |node|
  if node.offline
    offline_count = (offline_count + 1)
    puts("⚠ " + (node.displayName).to_s + " is OFFLINE")
    if node.offlineCauseReason
      puts("  Reason: " + (node.offlineCauseReason).to_s)
    end
  end
end
if (offline_count == 0)
  puts("All " + (nodes.length).to_s + " nodes are online.")
else
  puts((offline_count).to_s + " of " + (nodes.length).to_s + " nodes are offline.")
end
```
## Notes

- **Bearer auth**: All requests use Bearer token authentication. Generate a token from your Jenkins user profile.
- **Build results**: Common build result values are `SUCCESS`, `FAILURE`, `UNSTABLE`, `ABORTED`, and `null` (still in progress).
- **Job colors**: The `color` field on jobs indicates status — `blue` for success, `red` for failure, `yellow` for unstable, `grey` for never built, and `disabled` for disabled jobs.
- **Rate limiting**: Jenkins may rate-limit aggressive API usage. Use pagination parameters where available.
- **Folder jobs**: If your Jenkins uses folders, job names may include the folder path (e.g. `my-folder/my-job`).

---

## Multi-Account Usage

If you have multiple Jenkins instances configured, use account-specific namespaces:

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
