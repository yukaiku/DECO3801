using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class NounLinkage : MonoBehaviour
{
    public GameObject nounPanel;
    public string nounName;

    private GameObject nounObject;
    private Text[] allNounTexts;
    private Text nounText;

    private void getNounText()
    {
        nounObject = this.gameObject;
        allNounTexts = nounPanel.GetComponentsInChildren<Text>(true);
        for (int i = 0; i < allNounTexts.Length; ++i)
        {
            if (allNounTexts[i].text.Equals(nounName))
            {
                nounText = allNounTexts[i];
                Debug.Log(string.Format("A corresponding noun '{0}' text '{1}' found",
                        nounObject.name, nounText.text));
                break;
            }
        }

        if (nounText == null)
        {
            Debug.Log(string.Format("No such noun text found"));
        }
    }

    private void doDisableNounText()
    {
        if ((nounText != null) &&(nounText.gameObject.activeSelf))
        {
            nounText.gameObject.SetActive(false);
            Debug.Log(string.Format("Disable noun '{0}' text successful", nounObject.name));
        }
    }

    /* ********************************************************************************* *
     * ****************************** CUSTOM STUFFS ABOVE ****************************** *
     * ********************************************************************************* */

    private void OnMouseDown()
    {
        doDisableNounText();
    }

    // Start is called before the first frame update
    void Start()
    {
        getNounText();
    }

    // Update is called once per frame
    void Update()
    {
        
    }
}
