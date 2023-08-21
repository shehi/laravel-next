<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Enums\Sort;
use App\Repositories\CardRepository;
use App\Services\CardService;
use PHPUnit\Framework\MockObject\Exception;
use Tests\TestCase;

class CardServiceTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test__fetch(): void
    {
        $repoMock = $this->createMock(CardRepository::class);
        $repoMock
            ->expects(static::once())
            ->method('fetch')
            ->willReturn(
                '[
                    {"realName":"A","playerName":"Z","asset":"1"},
                    {"realName":"E","playerName":"V","asset":"5"},
                    {"realName":"B","playerName":"Y","asset":"2"},
                    {"realName":"D","playerName":"W","asset":"4"},
                    {"realName":"C","playerName":"X","asset":"3"}
                ]'
            );
        $this->instance(CardRepository::class, $repoMock);

        $service = app(CardService::class);
        $result = $service->fetch();

        static::assertEquals([
            ['realName' => 'A', 'playerName' => 'Z', 'asset' => '1'],
            ['realName' => 'E', 'playerName' => 'V', 'asset' => '5'],
            ['realName' => 'B', 'playerName' => 'Y', 'asset' => '2'],
            ['realName' => 'D', 'playerName' => 'W', 'asset' => '4'],
            ['realName' => 'C', 'playerName' => 'X', 'asset' => '3'],
        ], $result);
    }

    public static function dataProvider(): array
    {
        return [
            'asc' => [
                'sort' => Sort::ASC,
                'raw' => [
                    ['realName' => 'A', 'playerName' => 'Z', 'asset' => '1'],
                    ['realName' => 'E', 'playerName' => 'V', 'asset' => '5'],
                    ['realName' => 'B', 'playerName' => 'Y', 'asset' => '2'],
                    ['realName' => 'D', 'playerName' => 'W', 'asset' => '4'],
                    ['realName' => 'C', 'playerName' => 'X', 'asset' => '3'],
                ],
                'expected' => [
                    ['realName' => 'A', 'playerName' => 'Z', 'asset' => '1'],
                    ['realName' => 'B', 'playerName' => 'Y', 'asset' => '2'],
                    ['realName' => 'C', 'playerName' => 'X', 'asset' => '3'],
                    ['realName' => 'D', 'playerName' => 'W', 'asset' => '4'],
                    ['realName' => 'E', 'playerName' => 'V', 'asset' => '5'],
                ],
            ],
            'desc' => [
                'sort' => Sort::DESC,
                'raw' => [
                    ['realName' => 'A', 'playerName' => 'Z', 'asset' => '1'],
                    ['realName' => 'E', 'playerName' => 'V', 'asset' => '5'],
                    ['realName' => 'B', 'playerName' => 'Y', 'asset' => '2'],
                    ['realName' => 'D', 'playerName' => 'W', 'asset' => '4'],
                    ['realName' => 'C', 'playerName' => 'X', 'asset' => '3'],
                ],
                'expected' => [
                    ['realName' => 'E', 'playerName' => 'V', 'asset' => '5'],
                    ['realName' => 'D', 'playerName' => 'W', 'asset' => '4'],
                    ['realName' => 'C', 'playerName' => 'X', 'asset' => '3'],
                    ['realName' => 'B', 'playerName' => 'Y', 'asset' => '2'],
                    ['realName' => 'A', 'playerName' => 'Z', 'asset' => '1'],
                ],
            ],
            'none' => [
                'sort' => Sort::NONE,
                'raw' => [
                    ['realName' => 'A', 'playerName' => 'Z', 'asset' => '1'],
                    ['realName' => 'E', 'playerName' => 'V', 'asset' => '5'],
                    ['realName' => 'B', 'playerName' => 'Y', 'asset' => '2'],
                    ['realName' => 'D', 'playerName' => 'W', 'asset' => '4'],
                    ['realName' => 'C', 'playerName' => 'X', 'asset' => '3'],
                ],
                'expected' => [
                    ['realName' => 'A', 'playerName' => 'Z', 'asset' => '1'],
                    ['realName' => 'E', 'playerName' => 'V', 'asset' => '5'],
                    ['realName' => 'B', 'playerName' => 'Y', 'asset' => '2'],
                    ['realName' => 'D', 'playerName' => 'W', 'asset' => '4'],
                    ['realName' => 'C', 'playerName' => 'X', 'asset' => '3'],
                ],
            ],
        ];
    }

    /**
     * @dataProvider dataProvider
     *
     * @throws Exception
     */
    public function test__sort__asc(Sort $sort, array $data, array $expected): void
    {
        $service = app(CardService::class);
        $result = $service->sort($data, $sort);

        static::assertEquals($expected, $result);
    }
}
