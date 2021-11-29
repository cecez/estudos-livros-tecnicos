# FACTORY METHOD

Também conhecido como: Método fábrica, Construtor virtual

O Fac­tory Method é um pa­drão cri­a­ci­o­nal de pro­jeto que for­nece uma in­ter­face para criar ob­je­tos em uma su­per­classe, mas per­mite que as sub­clas­ses al­te­rem o tipo de ob­je­tos que serão criados.

- So­lu­ção
    - O pa­drão Fac­tory Method su­gere que você subs­ti­tua cha­ma­das di­re­tas de cons­tru­ção de ob­je­tos (usando o ope­ra­dor new) por cha­ma­das para um mé­todo fá­brica es­pe­cial. Não se pre­o­cupe: os ob­je­tos ainda são cri­a­dos atra­vés do ope­ra­dor new, mas esse está sendo cha­mado de den­tro do mé­todo fá­brica. Ob­je­tos re­tor­na­dos por um mé­todo fá­brica ge­ral­mente são cha­ma­dos de pro­du­tos.
    - ![](./factory-method.png)
    - À pri­meira vista, essa mu­dança pode pa­re­cer sem sen­tido: ape­nas mu­da­mos a cha­mada do cons­tru­tor de uma parte do pro­grama para outra. No en­tanto, con­si­dere o se­guinte: agora você pode so­bres­cre­ver o mé­todo fá­brica em uma sub­classe e al­te­rar a classe de pro­du­tos que estão sendo cri­a­dos pelo método.
    - Porém, há uma pe­quena li­mi­ta­ção: as sub­clas­ses só podem re­tor­nar tipos di­fe­ren­tes de pro­du­tos se esses pro­du­tos ti­ve­rem uma classe ou in­ter­face base em comum. Além disso, o mé­todo fá­brica na classe base deve ter seu tipo de re­torno de­cla­rado como essa interface.
    - ![](./factory-method2.png)

- Estrutura
    - ![](./estrutura.png)

- Pseudocódigo
    - “Este exem­plo ilus­tra como o Fac­tory Method pode ser usado para criar ele­men­tos de in­ter­face do usuá­rio mul­ti­pla­ta­forma sem aco­plar o có­digo do cli­ente às clas­ses de UI concretas.”
    - ![](./pseudocodigo.png)
    - 
    ```pascal
    // A classe criadora declara o método fábrica que deve retornar
    // um objeto de uma classe produto. As subclasses da criadora
    // geralmente fornecem a implementação desse método.
    class Dialog is
    // A criadora também pode fornecer alguma implementação
    // padrão do Factory Method.
    abstract method createButton():Button
    
    // Observe que, apesar do seu nome, a principal
    // responsabilidade da criadora não é criar produtos. Ela
    // geralmente contém alguma lógica de negócio central que
    // depende dos objetos produto retornados pelo método
    // fábrica. As subclasses pode mudar indiretamente essa
    // lógica de negócio ao sobrescreverem o método fábrica e
    // retornarem um tipo diferente de produto dele.
    method render() is
        // Chame o método fábrica para criar um objeto produto.
        Button okButton = createButton()
        // Agora use o produto.
        okButton.onClick(closeDialog)
        okButton.render()
        
    // Criadores concretos sobrescrevem o método fábrica para mudar
    // o tipo de produto resultante.
    class WindowsDialog extends Dialog is
      method createButton():Button is
        return new WindowsButton()
    
    class WebDialog extends Dialog is
      method createButton():Button is
        return new HTMLButton()

    // A interface do produto declara as operações que todos os
    // produtos concretos devem implementar.
    interface Button is
      method render()
      method onClick(f)

    // Produtos concretos fornecem várias implementações da
    // interface do produto.
    class WindowsButton implements Button is
      method render(a, b) is
        // Renderiza um botão no estilo Windows.
      method onClick(f) is
        // Vincula um evento de clique do SO nativo.

    class HTMLButton implements Button is
      method render(a, b) is
        // Retorna uma representação HTML de um botão.
      method onClick(f) is
        // Vincula um evento de clique no navegador web.

    class Application is
      field dialog: Dialog

      // A aplicação seleciona um tipo de criador dependendo da
      // configuração atual ou definições de ambiente.
      method initialize() is
        config = readApplicationConfigFile()

        if (config.OS == "Windows") then
          dialog = new WindowsDialog()
        else if (config.OS == "Web") then
          dialog = new WebDialog()
        else
          throw new Exception("Error! Unknown operating system.")

      // O código cliente trabalha com uma instância de um criador
      // concreto, ainda que com sua interface base. Desde que o
      // cliente continue trabalhando com a criadora através da
      // interface base, você pode passar qualquer subclasse da
      // criadora.
      method main() is
        this.initialize()
        dialog.render()

    ```


Trecho de
Mergulho nos Padrões de Projeto
Alexander Shvets
Este material pode estar protegido por copyright.