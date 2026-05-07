<?php
namespace OpenCompany\Integrations\Delighted\Tools;
/** Remove a person from email Autopilot. */
class DelightedRemoveAutopilotEmailMembership extends AbstractDelightedTool { protected const NAME = 'delighted_remove_autopilot_email_membership'; protected const DESCRIPTION = 'Remove a person from Delighted email Autopilot.'; protected const OPERATION = 'remove_autopilot_email_membership'; protected const REQUIRED = ['person']; }
