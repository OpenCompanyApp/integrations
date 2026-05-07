<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Finish Bitrise app registration. */
class BitriseFinishApp extends AbstractBitriseTool { protected const NAME = 'bitrise_finish_app'; protected const DESCRIPTION = 'Finish app registration by setting project type, stack, config, mode, envs, and ownership.'; protected const METHOD = 'finishApp'; protected const ARGUMENTS = ['app_slug']; protected const REQUIRED = ['app_slug', 'payload']; protected const USE_PAYLOAD = true; }
