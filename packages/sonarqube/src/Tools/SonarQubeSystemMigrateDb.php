<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Migrate the database to match the current version of SonarQube. Sending a POST request to this URL starts the DB migration. It is strongly advised to make a database backup before invoking this WS. State values are:- NO_MIGRATION: DB is up to date with current version of SonarQube.; - NOT_SUPPORTED: Migration is not supported on embedded databases.; - MIGRATION_RUNNING: DB migration is under go.; - MIGRATION_SUCCEEDED: DB migration has run and has been successful.; - MIGRATION_FAILED: DB migration has run and failed. SonarQube must be restarted in order to retry a DB migration (optionally after DB has been restored from backup).; - MIGRATION_REQUIRED: DB migration is required.;.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/system/migrate_db.
 */
class SonarQubeSystemMigrateDb extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_system_migrate_db';
    protected const DESCRIPTION = 'Migrate the database to match the current version of SonarQube. Sending a POST request to this URL starts the DB migration. It is strongly advised to make a database backup before invoking this WS. State values are:- NO_MIGRATION: DB is up to date with current version of SonarQube.; - NOT_SUPPORTED: Migration is not supported on embedded databases.; - MIGRATION_RUNNING: DB migration is under go.; - MIGRATION_SUCCEEDED: DB migration has run and has been successful.; - MIGRATION_FAILED: DB migration has run and failed. SonarQube must be restarted in order to retry a DB migration (optionally after DB has been restored from backup).; - MIGRATION_REQUIRED: DB migration is required.;

Official SonarQube Web API endpoint: POST /api/system/migrate_db.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/system/migrate_db';
    protected const PARAM_MAP = array (
);
}
