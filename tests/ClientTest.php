<?php
/**
 * File for ClientTest
 */

namespace Warcott\Tests;

use Warcott\Client;
use GuzzleHttp\Client as GuzzleClient;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ClientTest
 * @package Warcott\Tests
 */
class ClientTest extends TestCase
{
    /** @var GuzzleClient|MockInterface */
    private $guzzleClientMock;

    protected function setUp()
    {
        $this->guzzleClientMock = \Mockery::mock(GuzzleClient::class);
        parent::setUp();
    }

    /** @test **/
    public function getDataset()
    {
        $expected = ['test'];
        $responseMock = \Mockery::mock(ResponseInterface::class);
        $responseMock->shouldReceive('getBody')->andReturnSelf();
        $responseMock->shouldReceive('__toString')->andReturn(json_encode($expected));

        $this->guzzleClientMock->shouldReceive('get')->andReturn($responseMock);

        $client = new Client($this->guzzleClientMock);
        $this->assertEquals($expected, $client->getDataset(['en']));
    }
}