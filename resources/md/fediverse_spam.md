---
title: 2024年2月のFediverseスパム攻撃へのMICROPENの対応
category: misskey
back_to:
    title: MICROPEN情報
    url: /micropen
---
## 2024年2月のFediverseスパム攻撃へのMICROPENの対応

2024年2月25日 12:00 現在

現在、MastodonおよびMisskeyの多数のサーバーにおいて、不特定多数のアカウントに対してメンションを行うスパム行為が横行しています。

本件の対策のため、MICROPENでは、下記のような投稿に関して、
MICROPENに所属するユーザーにメンションが到達した場合、 **無期限のドメインブロック** を実施いたします。
ただし、サーバーの管理状況が良好で、直ちに当該スパムへの対応がされると見込まれる場合を除きます。

- 不特定多数のアカウントへの無差別的なメンションが含まれる場合
- 特定のDiscordサーバーのURLまたはそれを含む画像が投稿された場合
- 特定のクラッカー集団に関するWebサイトのURLが投稿された場合

上記に該当するサーバーをご利用の善良なるユーザーの方々には大変ご迷惑をおかけ致しますが、何卒よろしくお願い致します。

また、上記に該当するURLを含む投稿は、発信元を問わず、現在当サーバーでは受け取りを拒否しております。

なお、MICROPENは一般登録を開放しておりませんため、本件スパムの発信元とはなっておりません。
今後も適切なセキュリティ対策と監視を続けて参りますので、よろしくお願い致します。

### スパム対策として「ポジティブリスト方式」を導入しているサーバーに対する対応について

MICROPENでは、小規模サーバーとして、ユーザー同士の繋がりを連合機能に依存しております。

今回、一部の大規模サーバーにおいて、スパム対策として連合機能を大幅に制限し、ポジティブリストに記載されたサーバーとのみ連合している事例が確認されています。

そのようなサーバーについては、当サーバーとしては管理方針を信頼できないものとして無期限ブロックの対象と致します。ご理解のほどよろしくお願い致します。

### サーバー管理者メールアドレスの不正利用について

上記のMastodon・Misskeyインスタンスへの攻撃の際に、各サーバーの連絡先として掲出されていたメールアドレスが収集され、
各企業の問い合わせフォームに対し、極めて不穏当な投稿がなされる事案を確認しております。

MICROPENの管理者たるKuropenがMICROPEN上に掲出していたアドレス[^1]に関しても、2月17日14時以降、不正利用を確認しております。

メールアドレスを掲出している以上不正利用の可能性はある程度想定しておりましたが、
投稿されたメッセージは非常に悪質なものであり、誠に遺憾でございます。

この件に関しましては、2024年2月18日 8:50頃に、警察に情報提供を行いました。

なお今後同様の事案を防ぐため、メールアドレスに代え、[問い合わせフォーム](https://forms.office.com/r/VLAXRCN5M2)の
URLを掲出することと致しました。ご了承いただきますようお願いいたします。

[^1]: `eternie-labs.net` ドメインのものであります。

------

## MICROPEN Statement Regarding February 2024 Spam Attacks on Fediverse

Last Update: 12:00 p.m. JST,  February 25, 2024

Currently, there is a rampant spam activity on many servers of Mastodon and Misskey, 
where mentions are made to a large number of unspecified accounts.

To counter this issue, at MICROPEN, for the following types of posts, if a mention reaches a user belonging to MICROPEN, we will implement an **indefinite domain block**.
However, this excludes cases where the server management status is good and it is expected that the spam will be dealt with immediately.

- Cases where indiscriminate mentions to a large number of unspecified accounts are included
- Cases where an image containing the URL of a specific Discord server is posted
- Cases where the URL of the website of a specific cracker group is included in the post

We apologize for the inconvenience caused to the good users who use the servers that fall under the above. 
We appreciate your understanding.

Additionaly, currently, MICROPEN does not accept posts including aforementioned URLs, no matter where they come from.

Please note that MICROPEN does not open general registrations, so it is not the source of this spam.
We will continue to maintain appropriate security measures and monitoring, so we appreciate your understanding.

### Regarding the response to servers that have introduced a "positive list approach" as a spam countermeasure

At MICROPEN, as a small-scale server, we rely on the federation feature for connections between users.

We have confirmed cases where some large-scale servers have significantly restricted the federation feature as a spam countermeasure, and are only federating with servers listed on a positive list.

For such servers, we will consider them as indefinite block targets as we cannot trust their management policy. We appreciate your understanding.

### About the misuse of server administrator email addresses

During the above attacks on Mastodon and Misskey instances,
the email addresses shown as contact information for each server were collected,
and we have confirmed cases where extremely inappropriate posts were made to the inquiry forms of various companies.

We have confirmed misuse of the address[^2] of Kuropen, the administrator of MICROPEN, 
after 2:00 p.m. JST on February 17.

While we anticipated the possibility of misuse by showing the email address,
the posted messages are extremely malicious, which is truly regrettable.

Regarding this matter, we provided information to the police around 8:50 a.m. JST on February 18, 2024.

To prevent similar incidents in the future, we have decided to show the URL 
of the [inquiry form](https://forms.office.com/r/VLAXRCN5M2) instead of the email address. 
We appreciate your understanding.

[^2]: Its domain name is `eternie-labs.net` .
