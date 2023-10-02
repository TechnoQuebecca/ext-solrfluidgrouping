<?php

defined('TYPO3') or die();

(function () {
    if (class_exists(\ApacheSolrForTypo3\Solr\Search\SearchComponentManager::class)) {
        \ApacheSolrForTypo3\Solr\Search\SearchComponentManager::registerSearchComponent('fluid_grouping', \ApacheSolrForTypo3\Solrfluidgrouping\Search\GroupingComponent::class);
    }

    if (class_exists(\ApacheSolrForTypo3\Solr\Domain\Search\ResultSet\Result\Parser\ResultParserRegistry::class)) {
        /* @var \ApacheSolrForTypo3\Solr\Domain\Search\ResultSet\Result\Parser\ResultParserRegistry $parserRegistry */
        $parserRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\ApacheSolrForTypo3\Solr\Domain\Search\ResultSet\Result\Parser\ResultParserRegistry::class);

        $priority = 200;
        $registrationNotDone = true;
        do {
            try {
                $parserRegistry->registerParser(
                    \ApacheSolrForTypo3\Solrfluidgrouping\Domain\Search\ResultSet\Grouping\Parser\GroupedResultParser::class,
                    $priority++
                );
                $registrationNotDone = false;
            } catch (Exception) {
            }
        } while ($registrationNotDone && $priority < 220);
    }
})();
