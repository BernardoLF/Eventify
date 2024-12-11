# **Eventify**

**Eventify** é um sistema de gestão de eventos, onde utilizadores específicos podem colocarem os seus eventos e outros utilizadores podem-se inscrever.


---

## **Principais Funcionalidades**
1. **Registo e Login**:
   - Registo e autenticação de utilizadores.

2. **Criação de Eventos**:
   - Apenas Organizadores e administradores organizadores podem criar eventos.
   - O Organizador que criou o evento ou um Administrador pode editar o evento.

3. **Inscrição em eventos**:
   - Todos os utilizadores podem-se inscrever em qualquer evento.

4. **Listagem de eventos**:
   - Filtrar Eventos por categoria.

5. **Detalhes dos Eventos**:
   - Página com a informação completa de cada evento.

6. **Perfil de Utilizador**:
   - Cada utilizador terá um perfil com o histórico de eventos que já foi ou criou.

7. **Lista de Utilizadores**:
   - Apenas os Administradores poderão ter acesso a esta lista para alterar o cargo de **Participante** para **Organizador**
---

## **Fluxo de Navegação**

1. **Autenticação do Utilizador**:
   - Página de registo: Registo de novos utilizadores
   - Página de login: Autenticação de utilizadores já registados

2. **Lista de Eventos**
   - Exibição dos eventos disponíveis.
   - Filtrar eventos por categoria.

3. **Detalhes do Evento**
   - Informações completas sobre o evento.
   - Botão para inscrição (se houver vagas).

4. **Inscrição em Eventos**
   - Qualquer utilizador se pode inscrever no evento a partir da página do evento.
   - Sistema confirma a inscrição e atualiza o número de vagas.

5. **Área do Utilizador**
   - Exibe as informações do utilizador.
   - Histórico de eventos que tenha participado ou criado.

6. **Lista de Utilizadores**
   - Lista com todos os utilizadores do site com a opção de editar o cargo para **Participante** para **Organizador** 

---

## **Modelo Entidade-Relacionamento (ER)**
![Modelo ER](https://raw.githubusercontent.com/BernardoLF/Eventify/53950feb64235f429607d38d9a384343ca4b2363/Diagram.svg)

---

## **Perfis de Utilizadores**

1. **Participantes**:
   - Apenas têm acesso à dashboard dos eventos, e conseguem inscrever-se nos eventos disponíveis.
   - Têm disponível o seu perfil com o histórico de eventos que já frequentaram. 
   
2. **Organizadores**:
   - Permissões adicionais: Podem criar eventos e a seguir se for necessário editá-los.

3. **Administradores**:
   - Permissões adicionais: Têm acesso a uma lista de todos os utilizadores para poder alterar o seu cargo.

---

## **URL do Alojamento**

**[Eventify](http://bernardopedro.000.pe/)**