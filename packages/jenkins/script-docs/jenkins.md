# Jenkins — JavaScript API Reference

## Overview

The Jenkins integration provides access to CI/CD jobs, builds, nodes (agents), and user information. All 7 tools are available under the `app.integrations.jenkins` namespace.

Every tool call accepts a single JavaScript object with named parameters and returns a JavaScript object with the API response data.

## Authentication

The Jenkins integration authenticates via a **Bearer token** (API token). The token is sent as an Authorization header on every request.

To create an API token: **Jenkins → User → Configure → API Token**

```js
// All calls use the same namespace — no per-call auth needed
var jobs = app.integrations.jenkins.list_jobs({})
```
## Jobs

### `app.integrations.jenkins.list_jobs({})`

List all Jenkins jobs.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| *(none)* | — | — | Takes no parameters |

```js
var jobs = app.integrations.jenkins.list_jobs({})

for (const job of (jobs)) {
  console.log(job.name + " — " + (job.color || "unknown"))
}
```
### `app.integrations.jenkins.get_job({ job_name })`

Get details for a specific Jenkins job.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `job_name` | string | yes | The name of the Jenkins job |

```js
var job = app.integrations.jenkins.get_job({
  job_name: "my-project-build",
})

console.log(job.displayName)
console.log("Description: " + (job.description || "none"))
console.log("Last build: " + (job.lastBuild && job.lastBuild.number || "none"))
console.log("Health: " + (job.healthReport && job.healthReport[0] && job.healthReport[0].score || "N/A"))
```
### `app.integrations.jenkins.create_job({ name, mode, description, config })`

Create a new Jenkins job.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The name for the new job |
| `mode` | string | no | Job type: `freestyle`, `pipeline`, `maven`, `matrix`, or `multibranch` (default: `freestyle`) |
| `description` | string | no | A description for the job |
| `config` | table | no | Job configuration as a structured object |

```js
var job = app.integrations.jenkins.create_job({
  name: "my-new-pipeline",
  mode: "pipeline",
  description: "Build && test the main branch",
  config: {
    scm: {
      git: {
        url: "https://github.com/example/repo.git",
        branch: "main",
      },
    },
    triggers: { scm: { cron: "H/5 * * * *" } },
  },
})

console.log("Created job: " + job.name)
console.log("URL: " + job.url)
```
## Builds

### `app.integrations.jenkins.list_builds({ job_name, status })`

List builds for a specific Jenkins job.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `job_name` | string | yes | The name of the Jenkins job |
| `status` | string | no | Filter by status: `SUCCESS`, `FAILURE`, `UNSTABLE`, `ABORTED`, `IN_PROGRESS` |
| `per_page` | integer | no | Number of builds to return (default: 20) |

```js
var builds = app.integrations.jenkins.list_builds({
  job_name: "my-project-build",
})

for (const build of (builds)) {
  console.log("#" + build.number + " — " + build.result + " (" + build.duration + "ms)")
}
```
Filter by failed builds:

```js
var failures = app.integrations.jenkins.list_builds({
  job_name: "my-project-build",
  status: "FAILURE",
})

console.log("Failed builds: " + failures.length)
```
### `app.integrations.jenkins.get_build({ job_name, build_number })`

Get details for a specific build.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `job_name` | string | yes | The name of the Jenkins job |
| `build_number` | integer | yes | The build number |

```js
var build = app.integrations.jenkins.get_build({
  job_name: "my-project-build",
  build_number: 42,
})

console.log("Build #" + build.number)
console.log("Result: " + build.result)
console.log("Duration: " + build.duration + "ms")
console.log("Started: " + build.timestamp)
console.log("URL: " + build.url)

// Artifacts
if (build.artifacts) {
  for (const artifact of (build.artifacts)) {
    console.log("  Artifact: " + artifact.fileName)
  }
}

// Change sets
if (build.changeSets) {
  for (const cs of (build.changeSets)) {
    for (const item of (cs.items || [])) {
      console.log("  Commit: " + item.msg + " by " + item.author.fullName)
    }
  }
}
```
## Nodes

### `app.integrations.jenkins.list_nodes({})`

List all Jenkins nodes (agents).

| Name | Type | Required | Description |
|------|------|----------|-------------|
| *(none)* | — | — | Takes no parameters |

```js
var nodes = app.integrations.jenkins.list_nodes({})

for (const node of (nodes)) {
  var status = node.offline && "OFFLINE" || "ONLINE"
  console.log(node.displayName + " — " + status + " (executors: " + node.numExecutors + ")")
}
```
## User

### `app.integrations.jenkins.get_current_user({})`

Get the authenticated Jenkins user's profile. Useful to verify credentials and discover the username.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| *(none)* | — | — | Takes no parameters |

```js
var user = app.integrations.jenkins.get_current_user({})

console.log("ID: " + user.id)
console.log("Name: " + (user.fullName || "N/A"))
console.log("Email: " + (user.property && user.property.email || "N/A"))
```
## Common Workflows

### Check build status and diagnose failures

```js
var job_name = "my-project-build"

// 1. Get the job to find the last build number
var job = app.integrations.jenkins.get_job({ job_name: job_name })

if (job.lastBuild) {
  var build = app.integrations.jenkins.get_build({
    job_name: job_name,
    build_number: job.lastBuild.number,
  })

  console.log("Last build: #" + build.number + " — " + build.result)

  if (build.result === "FAILURE") {
    console.log("Build failed! Duration: " + build.duration + "ms")
    // Inspect console output or artifacts for debugging
  }
} else {
  console.log("No builds found for this job.")
}
```
### Monitor all jobs and report health

```js
var jobs = app.integrations.jenkins.list_jobs({})

for (const job of (jobs)) {
  var detail = app.integrations.jenkins.get_job({ job_name: job.name })
  var health = detail.healthReport && detail.healthReport[0] || {}

  console.log(job.name)
  console.log("  Health: " + (health.score || "N/A") + "/100")
  console.log("  " + (health.description || "No health report"))

  if (detail.lastBuild) {
    console.log("  Last build: #" + detail.lastBuild.number)
  }
}
```
### Create a pipeline job and verify

```js
// 1. Create the job
var job = app.integrations.jenkins.create_job({
  name: "deploy-production",
  mode: "pipeline",
  description: "Deploy to production environment",
})

// 2. Verify it was created
var detail = app.integrations.jenkins.get_job({ job_name: "deploy-production" })

console.log("Job created: " + detail.displayName)
console.log("Description: " + (detail.description || ""))
```
### Check node availability

```js
var nodes = app.integrations.jenkins.list_nodes({})

var offline_count = 0
for (const node of (nodes)) {
  if (node.offline) {
    offline_count = offline_count + 1
    console.log("⚠ " + node.displayName + " is OFFLINE")
    if (node.offlineCauseReason) {
      console.log("  Reason: " + node.offlineCauseReason)
    }
  }
}

if (offline_count === 0) {
  console.log("All " + nodes.length + " nodes are online.")
} else {
  console.log(offline_count + " of " + nodes.length + " nodes are offline.")
}
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

```js
// Default account (always works)
app.integrations.jenkins.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.jenkins.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.jenkins.production.function_name({ /* parameters */ })
app.integrations.jenkins.staging.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
