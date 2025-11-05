def analisar_estrutura(texto):
    feedback = []
    paragrafos = [p.strip() for p in texto.strip().split("\n") if p.strip()]

    # COMPETÊNCIA 2: Estrutura geral
    if len(paragrafos) < 3:
        feedback.append("Competência 2: A redação possui poucos parágrafos. Idealmente, deve conter introdução, dois desenvolvimentos e conclusão para garantir uma estrutura completa e bem organizada.")
    elif len(paragrafos) == 3:
        feedback.append("Competência 2: Sua redação apresenta uma estrutura básica com introdução, desenvolvimento e conclusão. Considere expandir o desenvolvimento para aprofundar os argumentos.")
    else:
        feedback.append("Competência 2: Ótimo! Sua redação apresenta uma estrutura adequada, com introdução, desenvolvimento e conclusão bem definidos.")

    # COMPETÊNCIA 2: Introdução
    if paragrafos:
        introducao = paragrafos[0].lower()
        if any(palavra in introducao for palavra in ["tema", "questão", "discutir", "problema", "contexto"]):
            if any(p in introducao for p in ["portanto", "é necessário", "urge", "deve-se", "precisa"]):
                feedback.append("Competência 2: A introdução contextualiza bem o tema e apresenta uma tese clara sobre o problema discutido.")
            else:
                feedback.append("Competência 2: A introdução contextualiza o tema, mas poderia apresentar uma tese mais explícita sobre o problema.")
        else:
            feedback.append("Competência 2: A introdução poderia contextualizar melhor o tema proposto, apresentando claramente o assunto que será discutido.")

    # COMPETÊNCIA 2: Desenvolvimento
    if len(paragrafos) > 2:
        desenvolvimento = paragrafos[1:-1]
        conectivos_desenvolvimento = ["além disso", "por outro lado", "em contrapartida", "por conseguinte", "dessa forma"]
        conectivos_presentes = any(any(c in p.lower() for c in conectivos_desenvolvimento) for p in desenvolvimento)

        if any(len(p.split()) > 60 for p in desenvolvimento):
            feedback.append("Competência 2: Os parágrafos de desenvolvimento estão extensos. Considere dividi-los para facilitar a leitura e a organização das ideias.")
        elif not conectivos_presentes:
            feedback.append("Competência 2: Os parágrafos de desenvolvimento estão bem distribuídos, mas faltam conectivos que garantam progressão entre os argumentos.")
        else:
            feedback.append("Competência 2: Os parágrafos de desenvolvimento estão bem distribuídos e articulados, facilitando a compreensão e a progressão dos argumentos.")

    # COMPETÊNCIA 2: Conclusão
    conclusao = paragrafos[-1].lower()
    conectivos_conclusivos = ["portanto", "conclui", "em suma", "dessa forma", "assim", "por fim", "em conclusão"]
    if any(palavra in conclusao for palavra in conectivos_conclusivos):
        feedback.append("Competência 2: A conclusão está bem sinalizada e encerra o texto de forma adequada, retomando o tema e apresentando um fechamento claro.")
    elif len(conclusao.split()) > 20:
        feedback.append("Competência 2: A conclusão está presente, mas poderia ser mais bem sinalizada com conectivos conclusivos.")
    else:
        feedback.append("Competência 2: A conclusão está pouco desenvolvida. Considere usar conectivos conclusivos e retomar a tese para encerrar o texto com mais força.")

    return feedback