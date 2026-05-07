<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** Get logs for one Drone build stage and step. */
class DroneCiGetBuildLogs extends AbstractDroneCiTool { protected const NAME = 'drone_ci_get_build_logs'; protected const DESCRIPTION = 'Get logs for one Drone build stage and step.'; protected const METHOD = 'getBuildLogs'; protected const REQUIRED = ['owner', 'repo', 'build', 'stage', 'step']; protected const PARAMETERS = ['owner' => ['type' => 'string', 'required' => true, 'description' => 'Repository owner.'], 'repo' => ['type' => 'string', 'required' => true, 'description' => 'Repository name.'], 'build' => ['type' => 'integer', 'required' => true, 'description' => 'Build number.'], 'stage' => ['type' => 'integer', 'required' => true, 'description' => 'Stage number.'], 'step' => ['type' => 'integer', 'required' => true, 'description' => 'Step number.']]; }
