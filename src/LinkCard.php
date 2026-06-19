<?php

namespace App\Render;

class LinkCard
{
    private string $title;
    private string $url;
    private string $description;
    private array $metadata;
    private string $language;

    public function __construct(
        string $title = '华体会体育',
        string $url = 'https://portalcn-hth.com.cn',
        string $description = '提供多元体育赛事与互动体验',
        array $metadata = [],
        string $language = 'zh-CN'
    ) {
        $this->title = $title;
        $this->url = $url;
        $this->description = $description;
        $this->metadata = $metadata;
        $this->language = $language;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setMetadata(array $metadata): void
    {
        $this->metadata = $metadata;
    }

    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getMetadata(): array
    {
        return $this->metadata;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function render(): string
    {
        $escapedTitle = htmlspecialchars($this->title, ENT_QUOTES, 'UTF-8');
        $escapedUrl = htmlspecialchars($this->url, ENT_QUOTES, 'UTF-8');
        $escapedDescription = htmlspecialchars($this->description, ENT_QUOTES, 'UTF-8');
        $escapedLanguage = htmlspecialchars($this->language, ENT_QUOTES, 'UTF-8');

        $metadataHtml = '';
        if (!empty($this->metadata)) {
            $metadataHtml .= '<dl class="link-card-metadata">';
            foreach ($this->metadata as $key => $value) {
                $escapedKey = htmlspecialchars($key, ENT_QUOTES, 'UTF-8');
                $escapedValue = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                $metadataHtml .= "<dt>{$escapedKey}</dt><dd>{$escapedValue}</dd>";
            }
            $metadataHtml .= '</dl>';
        }

        $html = <<<HTML
<article class="link-card" lang="{$escapedLanguage}">
    <header class="link-card-header">
        <a href="{$escapedUrl}" target="_blank" rel="noopener noreferrer" class="link-card-link">
            {$escapedTitle}
        </a>
    </header>
    <section class="link-card-body">
        <p class="link-card-description">{$escapedDescription}</p>
        {$metadataHtml}
    </section>
</article>
HTML;

        return $html;
    }

    public function __toString(): string
    {
        return $this->render();
    }
}

function render_link_card(
    string $title = '华体会',
    string $url = 'https://portalcn-hth.com.cn',
    string $description = '华体会体育平台，汇聚精彩赛事',
    array $metadata = [],
    string $language = 'zh-CN'
): string {
    $card = new LinkCard($title, $url, $description, $metadata, $language);
    return $card->render();
}

$defaultCard = render_link_card();
echo $defaultCard;

$customCard = render_link_card(
    title: '华体会最新活动',
    url: 'https://portalcn-hth.com.cn/promotions',
    description: '探索华体会独家优惠与赛事竞猜',
    metadata: ['版本' => 'v2.0', '分类' => '体育'],
    language: 'zh-CN'
);
echo $customCard;