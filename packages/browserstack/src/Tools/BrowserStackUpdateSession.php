<?php

namespace OpenCompany\Integrations\BrowserStack\Tools;

/** Update one BrowserStack Automate session. */
class BrowserStackUpdateSession extends AbstractBrowserStackTool { protected const NAME = 'browserstack_update_session'; protected const DESCRIPTION = 'Update one BrowserStack Automate session, such as status or reason.'; protected const METHOD = 'updateSession'; protected const ARGUMENTS = ['session_id']; protected const REQUIRED = ['session_id', 'payload']; protected const USE_PAYLOAD = true; }
