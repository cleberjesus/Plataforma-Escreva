import spacy
from collections import Counter

nlp = spacy.load("pt_core_news_sm")

def analisar_coesao(texto):
    feedback = []
    doc = nlp(texto)

    # COMPETÊNCIA 4: Tamanho das frases
    frases = list(doc.sents)
    frases_longas = [sent for sent in frases if len(sent) > 30]
    frases_curtas = [sent for sent in frases if len(sent) < 5]
    if len(frases_longas) >= 3:
        feedback.append("Competência 4: Há várias frases longas que dificultam a leitura. Divida em períodos menores para melhorar a clareza.")
    elif frases_longas:
        feedback.append("Competência 4: Algumas frases estão extensas. Considere revisar para facilitar a compreensão.")
    else:
        feedback.append("Competência 4: Ótimo! Suas frases estão bem distribuídas, tornando o texto claro e agradável de ler.")

    if len(frases_curtas) >= 3:
        feedback.append("Competência 4: Há muitas frases curtas em sequência. Isso pode prejudicar a fluidez. Tente unir ideias para formar períodos mais completos.")

    # COMPETÊNCIA 4: Repetição de palavras
    palavras = [t.text.lower() for t in doc if not t.is_punct and not t.is_stop]
    contagem = Counter(palavras)
    repetidas = [p for p, freq in contagem.items() if freq > 4]
    if repetidas:
        feedback.append(f"Competência 4: Evite repetição excessiva de palavras como: {', '.join(repetidas[:3])}. Use sinônimos para enriquecer o vocabulário.")
    elif any(freq > 2 for freq in contagem.values()):
        feedback.append("Competência 4: Há algumas repetições de palavras. Tente variar o vocabulário para evitar monotonia.")
    else:
        feedback.append("Competência 4: Muito bom! Não há repetição excessiva, o que demonstra riqueza vocabular.")

    # COMPETÊNCIA 4: Conectivos
    conectivos = {
        "portanto", "contudo", "entretanto", "além disso", "porém", "logo", "ou seja", "assim",
        "dessa forma", "todavia", "no entanto", "consequentemente", "por conseguinte", "por outro lado"
    }
    usados = set(t.text.lower() for t in doc if t.text.lower() in conectivos)
    if len(usados) >= 4:
        feedback.append("Competência 4: Excelente uso de conectivos! Isso garante coesão, fluidez e progressão lógica entre as ideias.")
    elif 2 <= len(usados) < 4:
        feedback.append("Competência 4: Bom uso de conectivos, mas você pode variar mais para enriquecer a coesão textual.")
    elif len(usados) == 1:
        feedback.append("Competência 4: Poucos conectivos encontrados. Varie e utilize mais conectivos para melhorar a fluidez entre as ideias.")
    else:
        feedback.append("Competência 4: Não foram encontrados conectivos no texto. O uso de conectivos é essencial para garantir coesão e lógica entre as ideias.")

    # COMPETÊNCIA 4: Pronomes
    pronomes = [t.text.lower() for t in doc if t.pos_ == "PRON"]
    if len(pronomes) >= 6:
        feedback.append("Competência 4: Excelente uso de pronomes! Isso contribui para evitar repetições e garantir coesão referencial.")
    elif 3 <= len(pronomes) < 6:
        feedback.append("Competência 4: Bom uso de pronomes, o que ajuda na coesão textual.")
    else:
        feedback.append("Competência 4: Pouco uso de pronomes. Eles ajudam a evitar repetições e manter a coesão referencial.")

    return feedback
