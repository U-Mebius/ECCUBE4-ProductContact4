## 問い合わせメールに商品情報を追加する方法(要作業)
管理画面の設定>店舗設定>メール設定>問合受付メールで、テンプレートを修正する必要がございます。  
IDEでテンプレートファイルを修正していただいても問題ございません。  

### テキストメール
テキストのタブで商品情報を追加したい場所に下記コードを追加してください。
`{{ include('@ProductContact4/Mail/product.twig', ignore_missing = true) }}`

### HTMLメール
HTMLのタブで商品情報を追加したい場所に下記コードを追加してください。  
`{{ include('@ProductContact4/Mail/product_html.twig', ignore_missing = true) }}`
