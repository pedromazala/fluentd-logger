<?php

namespace Tokenly\FluentdLogger;

use Fluent\Logger\LoggerInterface;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

/**
 * Class FluentMonologHandler
 */
class FluentMonologHandler extends AbstractProcessingHandler
{
    /** @var LoggerInterface */
    protected $logger;

    /** @var string */
    protected $tag;

    /**
     * FluentMonologHandler constructor.
     *
     * @param LoggerInterface $logger
     * @param null|string $tag
     * @param int $level
     * @param bool $bubble
     */
    public function __construct(LoggerInterface $logger, $tag, $level = Logger::DEBUG, $bubble = true)
    {
        $this->logger = $logger;
        $this->tag = $tag;

        parent::__construct($level, $bubble);
    }

    /**
     * @param array $record
     */
    protected function write(array $record)
    {
        $this->logger->post(
            $this->tag,
            [
                'level' => $record['level_name'],
                'message' => $record['message'],
                'context' => $record['context'],
                'mt' => intval(round(microtime(true) * 1000000)),
            ]
        );
    }
}