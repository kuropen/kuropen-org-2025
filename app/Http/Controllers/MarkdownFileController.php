<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <hy-kuropen@eternie-labs.net>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Exception\CommonMarkException;
use Webuni\FrontMatter\FrontMatter;
use Webuni\FrontMatter\Markdown\FrontMatterLeagueCommonMarkExtension;

/**
 * Markdownファイルをそのまま表示するコントローラ
 * @method \Illuminate\View\View legal()
 * @method \Illuminate\View\View contact()
 * @method \Illuminate\View\View micropen_terms()
 * @method \Illuminate\View\View social_policy()
 * @method \Illuminate\View\View about()
 */
class MarkdownFileController extends Controller
{
    private readonly FrontMatterLeagueCommonMarkExtension $extension;
    public function __construct(
        private readonly FrontMatter $frontMatter,
    )
    {
        $this->extension = new FrontMatterLeagueCommonMarkExtension($this->frontMatter);
    }

    /**
     * メソッド名として与えられたMarkdownファイルを表示する
     * @throws CommonMarkException
     */
    public function __call($method, $parameters)
    {
        $markdownDir = base_path('resources/md');
        $file = $markdownDir . '/' . $method . '.md';

        // 当該ファイルが存在しなければ404エラー
        abort_unless(file_exists($file), 404);

        // FrontMatterをパース
        $document = $this->frontMatter->parse(file_get_contents($file));

        // タイトルを取得
        $title = $document->getData()['title'] ?? '';

        // 戻り先を取得
        $backTo = array_merge(
            [
                'title' => 'トップページ',
                'url' => '/',
            ],
            $document->getData()['back_to'] ?? []
        );

        // CommonMarkでHTMLに変換
        $converter = new CommonMarkConverter([
            'html_input' => 'strip',
        ]);
        $converter->getEnvironment()->addExtension($this->extension);
        $content = $converter->convert($document->getContent());

        return view('markdown', compact('title', 'content', 'backTo'));
    }
}
