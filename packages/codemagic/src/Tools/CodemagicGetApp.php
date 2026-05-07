<?php

namespace OpenCompany\Integrations\Codemagic\Tools;

/** Get one Codemagic application. */
class CodemagicGetApp extends AbstractCodemagicTool { protected const NAME = 'codemagic_get_app'; protected const DESCRIPTION = 'Get one Codemagic application by application id.'; protected const METHOD = 'getApp'; protected const ARGUMENTS = ['app_id']; }
