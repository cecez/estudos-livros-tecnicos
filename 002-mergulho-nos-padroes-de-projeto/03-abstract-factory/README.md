 # ABSTRACT FACTORY (Fábrica abstrata)

 * padrão de projeto criacional que permite que você produza famílias de objetos relacionados sem ter que especificar suas classes concretas.

 - ![](./img1.png)
 - ![](./img2.png)

 - "Ge­ral­mente, o pro­grama cria um ob­jeto fá­brica con­creto no es­tá­gio de ini­ci­a­li­za­ção. Antes disso, o pro­grama deve se­le­ci­o­nar o tipo de fá­brica de­pen­dendo da con­fi­gu­ra­ção ou de­fi­ni­ções de ambiente."

 - Estrutura
    - ![](./img3.png)
    - 1. “Pro­du­tos Abs­tra­tos de­cla­ram in­ter­fa­ces para um con­junto de pro­du­tos dis­tin­tos mas re­la­ci­o­na­dos que fazem parte de uma fa­mí­lia de produtos.
    - 2. Pro­du­tos Con­cre­tos são vá­rias im­ple­men­ta­ções de pro­du­tos abs­tra­tos, agru­pa­dos por va­ri­an­tes. Cada pro­duto abs­trato (ca­deira/sofá) deve ser im­ple­men­tado em todas as va­ri­an­tes dadas (Vi­to­ri­ano/Mo­derno).
    - 3. A in­ter­face Fá­brica Abs­trata de­clara um con­junto de mé­to­dos para cri­a­ção de cada um dos pro­du­tos abstratos.
    - 4. Fá­bri­cas Con­cre­tas im­ple­men­tam mé­to­dos de cri­a­ção fá­brica abs­tra­tos. Cada fá­brica con­creta cor­res­ponde a uma va­ri­ante es­pe­cí­fica de pro­du­tos e cria ape­nas aque­las va­ri­an­tes de produto.
    - 5. Em­bora fá­bri­cas con­cre­tas ins­tan­ciam pro­du­tos con­cre­tos, as­si­na­tu­ras dos seus mé­to­dos de cri­a­ção devem re­tor­nar pro­du­tos abs­tra­tos cor­res­pon­den­tes. Dessa forma o có­digo cli­ente que usa uma fá­brica não fica li­gada a va­ri­ante es­pe­cí­fica do pro­duto que ele pegou de uma fá­brica. O Cli­ente pode tra­ba­lhar com qual­quer va­ri­ante de pro­duto/fá­brica con­creto, desde que ele se co­mu­ni­que com seus ob­je­tos via in­ter­fa­ces abstratas.”

- Pseudocódigo
    - ![](./img4.png)
    - Com essa abor­da­gem, o có­digo cli­ente não de­pende de clas­ses con­cre­tas de fá­bri­cas e ele­men­tos UI desde que ele tra­ba­lhe com esses ob­je­tos atra­vés de suas in­ter­fa­ces abs­tra­tas. Isso tam­bém per­mite que o có­digo do cli­ente su­porte ou­tras fá­bri­cas ou ele­men­tos UI que você possa adi­ci­o­nar no futuro.
    - Como re­sul­tado, você não pre­cisa mo­di­fi­car o có­digo do cli­ente cada vez que adi­ci­o­nar uma va­ri­a­ção de ele­men­tos de UI em sua apli­ca­ção. Você só pre­cisa criar uma nova classe fá­brica que pro­duza esses ele­men­tos e mo­di­fi­car de forma sutil o có­digo de ini­ci­a­li­za­ção da apli­ca­ção de forma que ele se­le­ci­one aquela classe quando apropriado.


Trechos de
Mergulho nos Padrões de Projeto
Alexander Shvets
Este material pode estar protegido por copyright.