/**
 * prose クラスの中の a タグの href 属性が http または https で始まる場合、
 * target 属性を _blank に設定し、rel 属性に noopener を追加する。
 * さらに、class=external-link を追加する。
 */
export default function proseExtLink()
{
    // class=prose の中の a タグを取得
    const links = document.querySelectorAll('.prose a');
    links.forEach((link) => {
        // a タグの href 属性を取得
        const href = link.getAttribute('href');
        // href 属性が http または https で始まる場合
        if (href && (href.startsWith('http://') || href.startsWith('https://'))) {
            // target 属性を _blank に設定
            link.setAttribute('target', '_blank');
            // rel 属性に noopener を追加
            link.setAttribute('rel', 'noopener');
            // class=external-link を追加
            link.classList.add('external-link');
        }
    });
}
