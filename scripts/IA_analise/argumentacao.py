def analisar_argumentacao(texto):
    feedback = []
    texto_lower = texto.lower()

    # COMPETÊNCIA 2: Repertório sociocultural (3 níveis)
    feedbacks_repertorio = {
        "excelente": "Competência 2: Você utilizou repertório sociocultural legitimado e relevante, o que demonstra domínio do tema e enriquece sua argumentação.",
        "genérico": "Competência 2: Há repertório sociocultural, mas ele poderia ser mais específico ou aprofundado. Tente usar dados, autores ou eventos marcantes.",
        "ausente": "Competência 2: Não identifiquei repertório sociocultural. Considere inserir dados, citações ou referências históricas para fortalecer seus argumentos."
    }

    exemplos_repertorio = [
        "segundo", "de acordo com", "conforme", "como diz", "pesquisa", "ibge", "onu", "filósofo",
        "historiador", "relatório", "estudo", "artigo", "dados do ibge", "segundo aristóteles", "segundo a onu"
    ]
    repertorio = any(expr in texto_lower for expr in exemplos_repertorio)

    if repertorio and any(ref in texto_lower for ref in ["ibge", "onu", "filósofo", "historiador", "relatório", "estudo"]):
        feedback.append(feedbacks_repertorio["excelente"])
    elif repertorio:
        feedback.append(feedbacks_repertorio["genérico"])
    else:
        feedback.append(feedbacks_repertorio["ausente"])

    # COMPETÊNCIA 3: Expressões opinativas (2 níveis)
    opinativos = {"acho", "penso", "acredito", "creio"}
    encontrados = [palavra for palavra in opinativos if palavra in texto_lower]
    if encontrados:
        feedback.append(f"Competência 3: Evite expressões opinativas como '{', '.join(encontrados)}', pois tornam o texto subjetivo. Prefira argumentos baseados em fatos, dados ou referências.")
    else:
        feedback.append("Competência 3: Sua argumentação está objetiva e fundamentada, sem uso de expressões opinativas.")

    # COMPETÊNCIA 3: Conectivos argumentativos (3 níveis)
    conectivos_argumentativos = {
        "portanto", "logo", "além disso", "por conseguinte", "dessa forma", "assim", "contudo", "porém",
        "em contrapartida", "por outro lado"
    }
    conectivos_usados = [c for c in conectivos_argumentativos if c in texto_lower]

    if len(conectivos_usados) >= 4:
        feedback.append("Competência 3: Excelente uso de conectivos argumentativos! As ideias estão bem articuladas e fluem com clareza.")
    elif 2 <= len(conectivos_usados) < 4:
        feedback.append("Competência 3: Bom uso de conectivos argumentativos, mas você pode variar mais para enriquecer a progressão das ideias.")
    else:
        feedback.append("Competência 3: Poucos conectivos argumentativos encontrados. Use expressões como 'além disso', 'por outro lado', 'portanto' para melhorar a fluidez.")

    # COMPETÊNCIA 5: Proposta de intervenção (3 níveis)
    termos_de_intervencao = {
        "governo", "educação", "campanha", "medida", "política pública", "sociedade", "família", "escola", "projeto"
    }
    encontrou_intervencao = any(p in texto_lower for p in termos_de_intervencao)
    detalhamento = any(expr in texto_lower for expr in [
        "deve", "deveria", "é necessário", "precisa", "urge", "fundamental que", "com o objetivo de", "a fim de"
    ])

    if encontrou_intervencao and detalhamento:
        feedback.append("Competência 5: Excelente! Sua proposta de intervenção está clara e detalhada, indicando agentes, ações e objetivos.")
    elif encontrou_intervencao:
        feedback.append("Competência 5: Sua proposta de intervenção está presente, mas falta detalhamento. Indique quem deve agir, como e com qual objetivo.")
    else:
        feedback.append("Competência 5: Não identifiquei uma proposta clara de intervenção social. Sugira uma solução viável, com agente, ação e finalidade.")

    return feedback