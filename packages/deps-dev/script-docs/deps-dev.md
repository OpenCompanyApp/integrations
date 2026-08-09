# deps.dev

Namespace: `deps-dev`

Use this integration to query deps.dev Open Source Insights package metadata,
version metadata, declared requirements, resolved dependencies, source projects,
project-to-package mappings, OSV advisories, and content-hash lookups.

## Authentication

The deps.dev API v3 is public and requires no credentials.

## Tools

- `deps_dev_package`: package metadata and available versions.
- `deps_dev_version`: metadata for one package version, including licenses,
  advisories, links, attestations, registries, and related projects.
- `deps_dev_requirements`: declared dependency requirements in the package
  system's native shape.
- `deps_dev_dependencies`: resolved dependency graph for ecosystems supported
  by deps.dev dependency resolution.
- `deps_dev_project`: source repository metadata, such as stars, forks, license,
  homepage, and embedded Scorecard data when known.
- `deps_dev_project_package_versions`: package versions mapped to a source
  project.
- `deps_dev_advisory`: OSV advisory metadata known to deps.dev.
- `deps_dev_query`: query package versions by base64 content hash,
  `system`/`name`/`version`, or both.

## Systems

Valid `system` values are `GO`, `RUBYGEMS`, `NPM`, `CARGO`, `MAVEN`, `PYPI`,
and `NUGET`. Maven package names use `group:artifact`, for example
`org.apache.logging.log4j:log4j-core`.

## Return Notes

This package keeps deps.dev field names intact. Dependency graphs return
`nodes`, `edges`, and `error`. Query responses return `results`, with at most
1000 results from the API.

## Examples

```js
var packageInfo = tools.deps_dev_package({
  system: "NPM",
  name: "react",
})

var version = tools.deps_dev_version({
  system: "MAVEN",
  name: "org.apache.logging.log4j:log4j-core",
  version: "2.15.0",
})

var graph = tools.deps_dev_dependencies({
  system: "NPM",
  name: "react",
  version: "18.2.0",
})
```
Path parameters are encoded by the integration. Pass package names and project
IDs in their natural form rather than pre-encoding them.
