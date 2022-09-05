## 問い合わせメールに商品情報を追加する方法 (インストール後に作業が必要)
管理画面の設定>店舗設定>メール設定>問合受付メールで、テンプレートを修正する必要がございます。  
IDEでEC-CUBEのapp/templte/{template_code}/Mail内テンプレートファイルを修正していただいても問題ございません。  

### テキストメール
テキストのタブで商品情報を追加したい場所に下記コードを追加してください。
`{{ include('@ProductContact42/Mail/product.twig', ignore_missing = true) }}`

追加した場所に次のような要素が挿入されます。
```
{% if data.Product %}商品：{{ data.Product.name }}(ID:{{ data.Product.id }}){% endif %}
```

### HTMLメール
HTMLのタブで商品情報を追加したい場所に下記コードを追加してください。  
`{{ include('@ProductContact42/Mail/product_html.twig', ignore_missing = true) }}`

追加した場所に次のような要素が挿入されます。
```
{% if data.Product %}
<dl style="display: flex;border-bottom: 1px dotted #ccc;margin: 0;">
    <dt style="padding-top: 14px;width: 30%;"><label class="ec-label">商品</label></dt>
    <dd style="width: 70%;line-height: 3;">{{ data.Product.name }}(ID:{{ data.Product.id }})</dd>
</dl>
{% endif %}
```
