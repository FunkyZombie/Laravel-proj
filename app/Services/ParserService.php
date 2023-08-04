<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\Contracts\Parser;
use \Orchestra\Parser\Xml\Facade;

class ParserService implements Parser
{
    private string $link;

	/**
	 * @param string $link
	 * @return Parser
	 */
	public function setLink(string $link): Parser {
        $this->link = $link;
        return $this;
	}
	
	/**
	 * @return void
	 */
	public function saveParseData(): void {

        $xml = Facade::load($this->link);

        $data = $xml->parse([
            'title' => [
                'uses' => 'channel.title',
            ],
            'link' => [
                'uses' => 'channel.link',
            ],
            'description' => [
                'uses' => 'channel.description',
            ],
            'image' => [
                'uses' => 'channel.image.url',
            ],
            'news' => [
                'uses' => 'channel.item[title,link,author,description,pubDate]'
            ],
        ]);

        dd($data);
	}
}
