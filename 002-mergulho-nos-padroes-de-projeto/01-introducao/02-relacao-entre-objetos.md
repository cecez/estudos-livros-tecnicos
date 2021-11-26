# Relação entre objetos

- Dependência
    - “A de­pen­dên­cia é o mais bá­sico e o mais fraco tipo de re­la­ções entre clas­ses. Existe uma de­pen­dên­cia entre duas clas­ses se al­gu­mas mu­dan­ças na de­fi­ni­ção de uma das clas­ses pode re­sul­tar em mo­di­fi­ca­ções em outra classe.”

- Associação
    - “A as­so­ci­a­ção é um re­la­ci­o­na­mento no qual um ob­jeto usa ou in­te­rage com outro.”
    - “A pro­pó­sito, ter uma as­so­ci­a­ção bi-di­re­ci­o­nal é uma coisa com­ple­ta­mente nor­mal.”
    - “Ima­gine que você tem uma classe Professor”
    ```
    class Professor is 
        field Student student
        // ...
        method teach(Course c) is
            // ...
            this.student.remember(c.getKnowledge())
    ```
    - “Ob­serve o mé­todo ensinar. Ele pre­cisa de um ar­gu­mento da classe Curso, que então é usado no corpo do mé­todo. Se al­guém muda o mé­todo obterConhecimento da classe Curso (al­tera seu nome, ou adi­ci­ona al­guns pa­râ­me­tros ne­ces­sá­rios, etc) nosso có­digo irá que­brar. Isso é cha­mado de dependência. Agora olha para o campo aluno e como ele é usado no mé­todo ensinar. Nós po­de­mos dizer com cer­teza que a classe Aluno é tam­bém uma de­pen­dên­cia para a classe Professor: se o mé­todo lembrar mudar, o có­digo da Professor irá que­brar. Con­tudo, uma vez que o campo aluno está sem­pre aces­sí­vel para qual­quer mé­todo do Professor, a classe Aluno não é ape­nas uma de­pen­dên­cia, mas tam­bém uma associação.”

- Agregação
    - “A agre­ga­ção é um tipo es­pe­ci­a­li­zado de as­so­ci­a­ção que re­pre­senta re­la­ções in­di­vi­du­ais (one-to-many), múl­ti­plas (many-to-many), e to­tais (whole-part) entre múl­ti­plos objetos."
    - Ge­ral­mente, sob agre­ga­ção, um ob­jeto “tem” um con­junto de ou­tros ob­je­tos e serve como um con­têi­ner ou co­le­ção. O com­po­nente pode exis­tir sem o con­têi­ner e pode ser li­gado atra­vés de vá­rios con­têi­ne­res ao mesmo tempo.”

- Composição
    - “A com­po­si­ção é um tipo es­pe­cí­fico de agre­ga­ção, onde um ob­jeto é com­posto de um ou mais ins­tân­cias de outro. A dis­tin­ção entre esta re­la­ção e as ou­tras é que o com­po­nente só pode exis­tir como parte de um con­têi­ner.”