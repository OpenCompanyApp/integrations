<?php
namespace OpenCompany\Integrations\Delighted\Tools;
/** Unsubscribe a Delighted person. */
class DelightedUnsubscribePerson extends AbstractDelightedTool { protected const NAME = 'delighted_unsubscribe_person'; protected const DESCRIPTION = 'Unsubscribe a person from Delighted surveys.'; protected const OPERATION = 'unsubscribe_person'; protected const REQUIRED = ['person']; }
