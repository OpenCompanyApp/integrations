<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** Decline one Drone build. */
class DroneCiDeclineBuild extends AbstractDroneCiTool { protected const NAME = 'drone_ci_decline_build'; protected const DESCRIPTION = 'Decline one Drone build.'; protected const METHOD = 'declineBuild'; protected const REQUIRED = ['owner', 'repo', 'build']; protected const PARAMETERS = ['owner' => ['type' => 'string', 'required' => true, 'description' => 'Repository owner.'], 'repo' => ['type' => 'string', 'required' => true, 'description' => 'Repository name.'], 'build' => ['type' => 'integer', 'required' => true, 'description' => 'Build number.']]; }
