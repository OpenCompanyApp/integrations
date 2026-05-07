<?php
namespace OpenCompany\Integrations\Delighted\Tools;
/** Send a survey to a person. */
class DelightedSendPerson extends AbstractDelightedTool { protected const NAME = 'delighted_send_person'; protected const DESCRIPTION = 'Create or update a person and schedule a Delighted survey.'; protected const OPERATION = 'send_person'; protected const REQUIRED = ['email']; }
