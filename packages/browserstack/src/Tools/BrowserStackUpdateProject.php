<?php

namespace OpenCompany\Integrations\BrowserStack\Tools;

/** Update a BrowserStack Automate project. */
class BrowserStackUpdateProject extends AbstractBrowserStackTool { protected const NAME = 'browserstack_update_project'; protected const DESCRIPTION = 'Update BrowserStack Automate project details, such as name.'; protected const METHOD = 'updateProject'; protected const ARGUMENTS = ['project_id']; protected const REQUIRED = ['project_id', 'payload']; protected const USE_PAYLOAD = true; }
