using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.EventSystems;

public class MapPointerUtility : MonoBehaviour, IPointerEnterHandler, IPointerExitHandler
{
    public Texture2D defaultTexture;
    public Texture2D hoverTexture;
    public CursorMode cursorMode = CursorMode.Auto;
    public Vector2 hotSpot = Vector2.zero;

    private GameObject levelNoter;

    public void OnPointerEnter(PointerEventData eventData)
    {
        Cursor.SetCursor(hoverTexture, hotSpot, cursorMode);
        levelNoter.SetActive(true);
    }

    public void OnPointerExit(PointerEventData eventData)
    {
        Cursor.SetCursor(defaultTexture, hotSpot, cursorMode);
        levelNoter.SetActive(false);
    }

    // Start is called before the first frame update
    void Start()
    {
        levelNoter = transform.GetChild(0).gameObject;
        if (levelNoter == null)
        {
            Destroy(this);
            Debug.Log(string.Format("No noter attached to this map pointer and the component won't work"));
        }
    }

    // Update is called once per frame
    void Update()
    {
        
    }
}
