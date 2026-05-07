<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** Stop one Drone build. */
class DroneCiStopBuild extends AbstractDroneCiTool { protected const NAME = 'drone_ci_stop_build'; protected const DESCRIPTION = 'Stop one Drone build.'; protected const METHOD = 'stopBuild'; protected const REQUIRED = ['owner', 'repo', 'build']; protected const PARAMETERS = ['owner' => ['type' => 'string', 'required' => true, 'description' => 'Repository owner.'], 'repo' => ['type' => 'string', 'required' => true, 'description' => 'Repository name.'], 'build' => ['type' => 'integer', 'required' => true, 'description' => 'Build number.']]; }
