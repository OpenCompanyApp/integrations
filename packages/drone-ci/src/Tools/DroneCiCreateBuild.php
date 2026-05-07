<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** Create a Drone custom build. */
class DroneCiCreateBuild extends AbstractDroneCiTool { protected const NAME = 'drone_ci_create_build'; protected const DESCRIPTION = 'Create a Drone custom build using branch, commit, and custom parameter query values.'; protected const METHOD = 'createBuild'; protected const REQUIRED = ['owner', 'repo']; protected const PARAMETERS = ['owner' => ['type' => 'string', 'required' => true, 'description' => 'Repository owner.'], 'repo' => ['type' => 'string', 'required' => true, 'description' => 'Repository name.'], 'branch' => ['type' => 'string', 'description' => 'Branch name.'], 'commit' => ['type' => 'string', 'description' => 'Commit SHA.'], 'query' => ['type' => 'object', 'description' => 'Additional query parameters passed to the custom build.']]; }
