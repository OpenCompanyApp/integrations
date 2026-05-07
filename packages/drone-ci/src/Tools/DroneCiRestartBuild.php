<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** Restart one Drone build. */
class DroneCiRestartBuild extends AbstractDroneCiTool { protected const NAME = 'drone_ci_restart_build'; protected const DESCRIPTION = 'Restart one Drone build.'; protected const METHOD = 'restartBuild'; protected const REQUIRED = ['owner', 'repo', 'build']; protected const PARAMETERS = ['owner' => ['type' => 'string', 'required' => true, 'description' => 'Repository owner.'], 'repo' => ['type' => 'string', 'required' => true, 'description' => 'Repository name.'], 'build' => ['type' => 'integer', 'required' => true, 'description' => 'Build number.']]; }
