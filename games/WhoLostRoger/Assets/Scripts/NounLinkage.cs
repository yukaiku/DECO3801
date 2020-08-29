using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

// using the EventTrigger component for NOUN objects
public class NounLinkage : MonoBehaviour
{
    public GameObject nounPanel;
    public string nounName;

    private GameObject nounObject;
    private Text[] allNounTexts;
    private Text nounText;

    public void doDisableNounText()
    {
        if (nounText != null)
        {
            nounText.gameObject.SetActive(false);
            Debug.Log(string.Format("Disable noun '{0}' text successful", nounObject.name));
        }
        Debug.Log(string.Format("Disable noun '{0}' text failed", nounObject.name));
    }


    // Start is called before the first frame update
    void Start()
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

    // Update is called once per frame
    void Update()
    {
        if (Input.GetMouseButtonDown(0))
        {
            Vector3 mousePos = Camera.main.ScreenToWorldPoint(Input.mousePosition);
            Vector2 mousePos2D = new Vector2(mousePos.x, mousePos.y);

            RaycastHit2D hit = Physics2D.Raycast(mousePos2D, Vector2.zero);
            if (hit.collider != null)
            {
                Debug.Log(hit.collider.gameObject.name);
            }
        }
    }
}
