<?php
namespace OpenCompany\Integrations\Delighted\Tools;
/** Add a person to email Autopilot. */
class DelightedAddAutopilotEmailMembership extends AbstractDelightedTool { protected const NAME = 'delighted_add_autopilot_email_membership'; protected const DESCRIPTION = 'Add a person to Delighted email Autopilot.'; protected const OPERATION = 'add_autopilot_email_membership'; protected const REQUIRED = ['person']; }
