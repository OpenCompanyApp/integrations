<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Get one Bitrise app. */
class BitriseGetApp extends AbstractBitriseTool { protected const NAME = 'bitrise_get_app'; protected const DESCRIPTION = 'Get one Bitrise app by app slug.'; protected const METHOD = 'getApp'; protected const ARGUMENTS = ['app_slug']; }
